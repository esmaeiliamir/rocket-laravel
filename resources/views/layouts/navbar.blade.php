<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">راکت</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">درباره ما</a>
                </li>
                <li>
                    <a href="#">سرویس ها</a>
                </li>
                <li>
                    <a href="#">تماس با ما</a>
                </li>
                @if(!Auth::check())
                    <li>
                        <a href="/login">ورود</a>
                    </li>
                    <li>
                        <a href="/register">ثبت نام</a>
                    </li>
                @endif
                @if(Auth::check())
                    <li>
                        <a href="/">سلام {{ Auth::user()->name }}</a>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </li>


                @endif
            </ul>


        </div>
        <!-- /.navbar-collapse -->

    </div>
    <!-- /.container -->


</nav><?php
