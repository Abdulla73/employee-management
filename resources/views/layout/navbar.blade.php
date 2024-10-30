<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Employee Pro</a>
        </div>
        <form class="navbar-form" role="search" action="{{ route('employee-panel.employees.search') }}" method="GET">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search here..." name="search">
            </div>
            <button type="submit" class="btn-search">Search</button>
        </form>
        <button type="button" class="btn btn-logout navbar-btn pull-right">Logout</button>
    </div>
</nav>
