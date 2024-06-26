<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    @include('layouts.menu')

    @yield('content')

    @include('layouts.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/lib/easing/easing.min.js"></script>
    <script src="/lib/waypoints/waypoints.min.js"></script>
    <script src="/lib/lightbox/js/lightbox.min.js"></script>
    <script src="/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="/js/main.js"></script>

    <script src="/Source/toastr/toastr.min.js"></script>

    <script type="text/javascript">
        toastr.options = {
            closeButton: true, // Show close button
            timeOut: 0, // Set timeOut to 0 to make it sticky until user closes it
            extendedTimeOut: 0 // Set extendedTimeOut to 0 to make it sticky until user closes it
        };

        function showToast(message, type) {
            if (type === "info") {
                toastr.info(message);
            } else if (type === "success") {
                toastr.success(message);
            } else if (type === "error") {
                toastr.error(message);
            } else if (type === "warning") {
                toastr.warning(message);
            }
        }
    </script>

    @if (session('success'))
        <script type="text/javascript">
            showToast(
                "{{ session('success') }}",
                "success"
            );
        </script>
    @endif

    @if (session('error'))
        <script type="text/javascript">
            showToast(
                "{{ session('error') }}",
                "error"
            );
        </script>
    @endif
</body>

</html>
