<script>
    function showToast(type, message) {
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = Swal.stopTimer;
          toast.onmouseleave = Swal.resumeTimer;
        }
      });
      Toast.fire({
        icon: type,
        title: message
      });
    }
</script>
<script>
    function checkSession() {
      fetch('/check-session')
        .then(response => response.json())
        .then(data => {
            if (data.expired) {
                window.location.href = '/login'; // Redirect to login page
            }
        });
    }

    setInterval(checkSession, 300000); // 300,000 milliseconds = 5 minutes
</script>