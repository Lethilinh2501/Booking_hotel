<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('style')
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        @include('admin.layout.partials.sidebar')

        <!-- Main Content -->
        <div class="flex-grow-1 d-flex flex-column">

            <!-- Header -->
            @include('admin.layout.partials.header')


            <!-- Main Section -->
            @yield('content')

            <!-- Footer -->
            @include('admin.layout.partials.footer')
        </div>
    </div>
    @stack('scripts')

</body>

</html>
