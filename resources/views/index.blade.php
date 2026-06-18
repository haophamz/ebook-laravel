<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>

@if(auth()->check() && auth()->user()->hasVerifiedEmail())
    <h3>Xin chào, {{ auth()->user()->name }}</h3>
@else
    <h3>Xin chào, Khách</h3>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-top-right",
    timeOut: 3000
};
</script>

@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    toastr.success(@json(session('success')));
});
</script>
@endif

</body>
</html>