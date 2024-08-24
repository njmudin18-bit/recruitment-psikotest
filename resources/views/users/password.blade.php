<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>{{ $SubTitle }} | {{ config('appsproperties.APPS_NAME') }}</title>
    <!-- Meta header and App favicon start -->
    <x-meta-header :subtitle="$SubTitle"></x-metas>
    <!-- Meta header and App favicon end -->
    <!-- Css standard start -->
    <x-css-standard></x-css-standard>
    <!-- Css standard end -->
  </head>
  <body data-sidebar="dark" data-layout-mode="light">
    <!-- Begin page -->
    <div id="layout-wrapper">
      <!-- Topbar start -->
      <x-top-bar />
      <!-- Topbar start end -->

      <!-- Left Sidebar Start -->
      <x-left-side-bar />
      <!-- Left Sidebar End -->

      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="main-content">
        <div class="page-content">
          <div class="container-fluid">
            <!-- start page title -->
            <x-page-title :title="$Title" :subtitle="$SubTitle" />
            <!-- end page title -->

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <h5 class="card-header bg-transparent border-bottom">{{ $SubTitle }}</h5>
                  <div class="card-body">
                    <form id="registerForm">
                      <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-6">
                          <input type="password" name="NewPassword" id="NewPassword" class="form-control" placeholder="Password baru anda" maxlength="25">
                          <span class="help-block"></span>
                        </div>
                        <div class="col-sm-3">
                          <button id="btnSave" type="button" class="btn btn-primary" onclick="UpdatePassword()">Update password</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div> <!-- end col -->
            </div> <!-- end row -->
          </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        
        <!-- Footer start -->
        <x-footer-bar />
        <!-- Footer end -->
      </div>
      <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <x-right-side-bar />
    <!-- /Right-bar -->

    <!-- JAVASCRIPT start -->
    <x-js-standard></x-js-standard>
    <!-- JAVASCRIPT end -->

    <!-- Loader start -->
    <x-loader-component></x-loader-component>
    <!-- Loader end -->
    
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @include('components.swaltoast')

    <script>
      function UpdatePassword() {
        var formData = $('#registerForm').serializeArray();
        formData.push({ name: "_token", value: "{{ csrf_token() }}" });
        $.ajax({
          url : "{{ route('users.update-password') }}",
          type: "POST",
          data: formData,
          dataType: "JSON",
          beforeSend: function (params) {
            $("#loading").show();
          },
          success: function(data)
          {
            showToast('success', data.message);
            $('#btnSave').text('Save');
            $('#btnSave').attr('disabled',false);
            $("#loading").hide();
            $('#registerForm')[0].reset();
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            let data = jqXHR.responseJSON;
            if (data.status_code == 500) {
              for (var i = 0; i < data.inputerror.length; i++) 
              {
                $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error');
                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
              }
            } else {
              Swal.fire({
                title: capitalizeFirstLetter(textStatus),
                text: data.message,
                icon: "error"
              });
            }
            $("#loading").hide();
            $('#btnSave').text('Save');
            $('#btnSave').attr('disabled',false);
          }
        });
      }

      $(document).ready(function () {
        $("#loading").hide();

        $("#NewPassword").change(function(){
          $(this).parent().removeClass('has-error');
          $(this).next().empty();
        });
      });
    </script>
  </body>
</html>
