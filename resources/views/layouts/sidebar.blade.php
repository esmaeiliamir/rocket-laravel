<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>جستجو در بلاگ</h4>
        <form class="input-group" action="{{ route('search') }}">
            <input type="text" name="term" class="form-control">
            <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <?php
    $categories = \App\Models\Category::all();

    ?>
    <div class="well">
        <h4>دسته بندی بلاگ</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    @foreach($categories as $category)
                    <li><a href="{{ route('category.index', ['category' => $category->name]) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- /.col-lg-6 -->

            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>دیوار ابزار</h4>
        <p>در این بخش میتوانید ابزارهای خود را قرار دهید</p>
    </div>

</div>
