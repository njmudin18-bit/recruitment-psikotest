<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Storage;
use File;

class UserService
{
    public function dataTable()
    {
      $data = User::whereHas('roles', function ($query) {
          $query->where('name', '!=', 'admin');
      })->with('roles')
      ->orderBy('id', 'DESC')
      ->get();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn  = '<a href="' . url("users", $row->id) . '/edit" name="edit" data-id="' . $row->id . '" class="editRole btn btn-warning btn-sm" title="Edit"><i class="bx bx-edit"></i></a>';
          $actionBtn .= '<button type="button" name="delete" data-id="' . $row->id . '" class="deleteUser btn btn-danger btn-sm ms-1 me-1" title="Hapus"><i class="bx bx-x-circle"></i></button>';
          
          if ($row->email_verified_at == null) {
            $Aktifkan    = "'".$row->id."', 'Aktifkan'";
            $actionBtn  .= '<button type="button" name="delete" onclick="aktifkan_akun('.$Aktifkan.')" class="deleteUser btn btn-secondary btn-sm" title="Aktifkan akun"><i class="bx bx-user-minus"></i></button>';
          } else {
            $NonAktifkan = "'".$row->id."', 'NonAktifkan'";
            $actionBtn  .= '<button type="button" name="delete" onclick="aktifkan_akun('.$NonAktifkan.')" class="deleteUser btn btn-success btn-sm" title="Non aktifkan akun"><i class="bx bx-user-check"></i></button>';
          }
          
          return '<div class="d-flex">' . $actionBtn . '</div>';
        })
        ->addColumn('role', function ($row) {
          $roles = $row->roles->pluck('name')->toArray();

          return implode(', ', $roles);
        })
        ->addColumn('email_verified_at', function ($row) {
          $VerifyDate = $row->email_verified_at == null ? '-' : $row->email_verified_at;

          return $VerifyDate;
        })
        ->addColumn('created_at', function ($row) {
          $CreatedDate = $row->created_at;

          return $CreatedDate;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function dataTable_New()
    {
      $data = UserProfile::whereHas('user.roles', function ($query) {
        $query->where('name', '!=', 'admin');
      })->with('user.roles')->get();

      return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('nama_user', function ($row) {
        return $row->user->name;
      })
      ->editColumn('jenis_kelamin', function ($row) {
        return $row->jenis_kelamin == 'perempuan' ? 'P' : 'L';
      })
      ->addColumn('role', function ($row) {
        $roles = $row->user->roles->pluck('name')->toArray();
        return implode(', ', $roles);
      })
      ->addColumn('action', function ($row) {
        $actionBtn = '<a href="' . url("users", $row->user->id) . '/edit" name="edit" data-id="' . $row->user->id . '" class="editRole btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></a>';
        //$actionBtn  = '<button type="button" name="edit" data-id="' . $row->user->id . '" class="editUser btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
        $actionBtn .= '<button type="button" name="delete" data-id="' . $row->user->id . '" class="deleteUser btn btn-danger btn-sm" title="Hapus"><i class="bx bx-x-circle"></i></button>';
        
        return '<div class="d-flex">' . $actionBtn . '</div>';
      })
      ->rawColumns(['action'])
      ->make(true);
    }

    public function getById($id)
    {
      return User::findOrFail($id);
    }

    public function create($data)
    {
        DB::beginTransaction();

        try {
            // create user
            $user = $this->createUser($data);

            // create user profile
            $this->createUserProfile($data, $user);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan.',
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ];
        }
    }

    public function createUser($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // assign role
        $role = Role::find($data['role']);
        $user->assignRole($role);

        return $user;
    }

    public function createUserProfile($data, $user)
    {
        $userProfile = UserProfile::create([
            'user_id'       => $user->id,
            'no_hp'         => $data['no_hp'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat'        => $data['alamat']
        ]);

        if (isset($data['image'])) {
            $image      = $data['image'];
            $imageName  = time() . '.' . $image->getClientOriginalExtension();
            $Path       = "images/users/";
            $ImagePath  = $Path.$imageName;
            $image->move($Path, $imageName);
            //$image->move(public_path('assets/images/users'), $imageName);

            $userProfile->image = $ImagePath;
            $userProfile->save();
        }
    }

    public function update($data, $id)
    {
        //dd($data, $id);

        DB::beginTransaction();

        try {
            // find user
            $user = User::findOrFail($id);
            // update user
            $this->updateUser($data, $user);

            // update user profile
            $this->updateUserProfile($data, $user);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil diubah.',
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Gagal merubah data: ' . $e->getMessage()
            ];
        }
    }

    public function activated($data)
    {
      $Status = $data['Status'] === 'Aktifkan' ? Carbon::now() : null;

      try {
        $UserUpdated = User::where('id', $data['UserID'])->update(['email_verified_at' => $Status]);

        return response()->json([
          'status_code' => 200,
          'status'      => "success",
          'message'     => "Data berhasil disimpan"
        ], 200);
      } catch (\Exception $e) {
        return response()->json([
          'status_code' => 500,
          'status'      => "success",
          'message'     => "Data gagal disimpan ".$e->getMessage(),
          'data'        => array()
        ], 500);
      }
    }

    public function updateUser($data, $user)
    {
        //dd($data, $user);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => isset($data['password']) ? bcrypt($data['password']) : $user->password,
        ]);

        // sync role
        if (isset($data['role'])) {
            $role = Role::find($data['role']);
            $user->syncRoles([$role->id]);
        }

        return $user;
    }

    public function updateUserProfile($data, $user)
    {
      //dd($data, $user);
      $userProfile  = $user->profile;
      $Path         = "images/users/";
      if (isset($userProfile)) {
        $userProfile->update([
          'no_hp'         => $data['no_hp'],
          'tanggal_lahir' => $data['tanggal_lahir'],
          'jenis_kelamin' => $data['jenis_kelamin'],
          'alamat'        => $data['alamat']
        ]);

        // update image
        if (isset($data['image'])) {
          if ($userProfile && $userProfile->image) {
            $Id         = $user->id;
            $Dokumen    = UserProfile::where('user_id', $Id)->first();
            $OldDokumen = $Dokumen->image;
            File::delete($OldDokumen);
            //$Dokumen->delete();
            // $oldImagePath = public_path('images/users/' . $userProfile->image);
            // if (file_exists($oldImagePath)) {
            //   unlink($oldImagePath);
            // }
          }

          $image      = $data['image'];
          $imageName  = time() . '.' . $image->getClientOriginalExtension();
          $ImagePath  = $Path.$imageName;
          $image->move($Path, $imageName);

          $userProfile->image = $ImagePath;
          $userProfile->save();
        }

        return $userProfile;
      } else {
        $this->createUserProfile($data, $user);
      }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            // find user
            $user = User::find($id);

            // find user profile
            $userProfile = UserProfile::where('user_id', $id)->first();

            if ($user) {

                // delete user
                $this->deleteUser($user);

                // delete user profile
                $this->deleteUserProfile($userProfile);

                // delete user roles
                $user->roles()->detach();

                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Data berhasil dihapus.',
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Data tidak ditemukan.',
                ];
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage(),
            ];
        }
    }

    public function deleteUser($user)
    {
        return $user->delete();
    }

    public function deleteUserProfile($userProfile)
    {
        $imagePath    = null;
        if ($userProfile->image) {
          $imagePath  = public_path('images/users/' . $userProfile->image);
        }

        $userProfile->delete();

        if ($imagePath && file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    public function update_password(array $data) {
      try {
        $updateData = [
          'password' => bcrypt($data['NewPassword'])
        ];
        // update
        User::where('id', Auth::user()->id)->update($updateData);
        return response()->json([
          'status_code' => 200,
          'status'      => "success",
          'message'     => "Password berhasil diupdate"
        ], 200);
      } catch (\Exception $e) {
        return response()->json([
          'status_code' => 500,
          'status'      => "success",
          'message'     => "Password gagal diupdate ".$e->getMessage()
        ], 500);
      }
    }

    public function get_total_pelamar() {
      $data = UserProfile::whereHas('user.roles', function ($query) {
        $query->where('name', '=', 'pelamar');
      })->with('user.roles')->count();

      return $data;
    }

    public function get_total_pengguna() {
      $data = UserProfile::whereHas('user.roles', function ($query) {
        $query->where('name', '!=', 'pelamar');
      })->with('user.roles')->count();

      return $data;
    }
}
