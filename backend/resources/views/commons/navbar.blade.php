<header style="margin: 40px"> 
    <!-- ナビゲーションバー -->
    <nav class="navbar fixed-top navbar-expand-xl navbar-light bg-color">
      <div class="container-fluid">

        <!-- ホームリンク -->
        <a href="/" class="navbar-brand" aria-label="ホーム">
           <img class="logo center" src="{{ secure_asset('/img/welcom-main-photo/logo_new.png') }}" alt="">
        </a>

        <!-- 画面幅が狭い時に表示されるハンバーガーメニュー -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
          aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- メニュー -->
        <div class="collapse navbar-collapse" id="navbar">
          <ul class="navbar-nav">
            <li class="nav-item">
             
            </li>
            @if(Auth::check())
            <li class="nav-item">
            </li>
            <li class="nav-item">
              
            </li>
            <li class="nav-item">
             
            </li>
            <li class="nav-item">
              
            </li>
            <li class="nav-item">
             
            </li>
            <li class="nav-item">
                
            </li>
            <li class="nav-item">
                
            </li>
            <li class="nav-item">
                
            </li>
            <li class="nav-item"> 
            </li>
            <li class="nav-item">
                
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('logout')}}">ログアウト</a>
            </li>
            @else
             <li class="nav-item">
              <a class="nav-link" href="{{route('register')}}">会員登録</a>
            </li>
             <li class="nav-item">
               <a class="nav-link" href="{{route('login.get')}}">ログイン</a> 
            </li>
            <li class="nav-item">
               <a class="nav-link" href="{{}}">ヘルプBot</a> 
            </li>
            @endif
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
      <!--/.container-fluid -->
    </nav>

</header>

