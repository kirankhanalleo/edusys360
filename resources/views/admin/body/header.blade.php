@php
    $nameArray=explode(" ", $user->name);
    $firstName = array_shift($nameArray);
@endphp
<div class="main-top">
    <div>
        <h1>Edusys360 <span class="primary">Admin</span></h1>
    </div>
    <div class="top-menu">
        <button class="menu-btn" id="menu-btn">
            <span class="material-symbols-sharp">menu</span>
        </button>
        <button class="theme-toggler">
            <span class="material-symbols-sharp active">light_mode</span>
            <span class="material-symbols-sharp">dark_mode</span>
        </button>
        <div class="profile">
            <div class="info">
                <p>Hey, <b>{{ $firstName }}</b></p>
                <small class="text-muted">{{ $user->userrole }}</small>
            </div>
            <div class="profile-picture">
                <img  src="{{ (!empty($user->profileimg))?url('assets/userimages/profileimg/'.$user->profileimg): url('assets/userimages/no-image.jpg') }}" alt="user" onclick="toggleMenu()" class="user-avatar">
                <div class="profile-menu-wrap" id="profile-menu">
                    <div class="profile-menu">
                        <div class="user-info">
                            <img  src="{{ (!empty($user->profileimg))?url('assets/userimages/profileimg/'.$user->profileimg): url('assets/userimages/no-image.jpg') }}" alt="user" class="user-avatar">
                            <h3><b>{{ $user->name }}</b></h3>
                        </div>
                        <hr>
                        <a href="{{ route('view.profile') }}" class="profile-menu-link">
                            <span class="material-symbols-sharp">account_circle</span>
                            <p>Profile</p>   
                        </a>
                        <a href="{{ route('view.password') }}" class="profile-menu-link">
                            <span class="material-symbols-sharp">lock</span>
                            <p>Change Password</p>    
                        </a>
                        <a href="#" class="profile-menu-link">
                            <span class="material-symbols-sharp">settings</span>
                            <p>Settings</p>    
                        </a>
                        <hr>
                        <a href="{{ route('user.logout') }}" class="profile-menu-link danger">
                            <span class="material-symbols-sharp">logout</span>
                            <p>Logout</p>    
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>