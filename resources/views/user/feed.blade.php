<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LBSNAA Alumni">
    <meta name="keywords" content="LBSNAA Alumni">
    <meta name="author" content="LBSNAA Alumni">
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin_assets/images/logos/favicon.ico') }}">
    <title>User Feed - Alumni | Lal Bahadur Shastri National Academy of Administration</title>

    <!--Google font-->
    <link href="../../css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="../../css2-1?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Theme css -->
    <link id="change-link" rel="stylesheet" type="text/css" href="{{asset('user_assets/css/style.css')}}">

</head>

<body>


    <!-- loader start -->
    <div class="pre-loader">
        <header>
            <div class="mobile-fix-menu"></div>
            <div class="container-fluid custom-padding">
                <div class="header-section">
                    <div class="header-left">
                        <div class="brand-logo">
                            <a href="index.html">
                                <img src="{{ asset('admin_user_assets/images/logos/logo.png') }}" alt="logo" class="img-fluid blur-up lazyload">
                            </a>
                        </div>
                        <div class="search-box">
                            <i data-feather="search" class="icon iw-16 icon-light"></i>
                            <input type="text" class="form-control" placeholder="find friends...">
                        </div>
                        <ul class="btn-group">
                            <!-- home -->
                            <li class="header-btn home-btn">
                                <a class="main-link" href="index.html">
                                    <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="home"></i>
                                </a>
                            </li>
                            <!-- add friend -->
                            <li class="header-btn custom-dropdown dropdown-lg add-friend">
                                <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="user-plus"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-header">
                                        <span>friend request</span>
                                        <div class="mobile-close">
                                            <h5>close</h5>
                                        </div>
                                    </div>
                                    <div class="dropdown-content">
                                        <ul class="friend-list">
                                            <li>
                                                <div class="media">
                                                    <img src="{{asset('user_assets/images/user-sm/5.jpg')}}" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">Paige Turner</h5>
                                                            <h6> 1 mutual friend</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="action-btns">
                                                    <button type="button" class="btn btn-solid">confirm</button>
                                                    <button type="button" class="btn btn-outline ms-1">delete</button>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <img src="{{asset('user_assets/images/user-sm/6.jpg')}}" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">Paige Turner</h5>
                                                            <h6> 1 mutual friend</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="action-btns">
                                                    <button type="button" class="btn btn-solid">confirm</button>
                                                    <button type="button" class="btn btn-outline ms-1">delete</button>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <img src="{{asset('user_assets/images/user-sm/7.jpg')}}" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">Paige Turner</h5>
                                                            <h6> 1 mutual friend</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="action-btns">
                                                    <button type="button" class="btn btn-solid">confirm</button>
                                                    <button type="button" class="btn btn-outline ms-1">delete</button>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <img src="{{asset('user_assets/images/user-sm/2.jpg')}}" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">Paige Turner</h5>
                                                            <h6> 1 mutual friend</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="action-btns">
                                                    <button type="button" class="btn btn-solid">confirm</button>
                                                    <button type="button" class="btn btn-outline ms-1">delete</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="header-right">
                        <div class="post-stats">
                            <ul>
                                <li>
                                    <a href="#">
                                        <h3>326</h3>
                                        <span>total posts</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h3>2456</h3>
                                        <span>total friends</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <ul class="option-list">
                            <!-- message -->
                            <li class="header-btn custom-dropdown dropdown-lg btn-group message-btn">
                                <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-light stroke-width-3 iw-16 ih-16"
                                        data-feather="message-circle"></i><span class="count success">2</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-header">
                                        <div class="left-title">
                                            <span>messages</span>
                                        </div>
                                        <div class="right-option">
                                            <ul>
                                                <li>
                                                    <a href="messanger.html">
                                                        <i class="iw-16 ih-16" data-feather="maximize"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="iw-16 ih-16" data-feather="edit"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="iw-16 ih-16" data-feather="more-horizontal"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mobile-close">
                                            <h5>close</h5>
                                        </div>
                                    </div>
                                    <div class="search-bar input-style icon-left">
                                        <i class="iw-16 ih-16 icon" data-feather="search"></i>
                                        <input type="text" class="form-control" placeholder="search messages...">
                                    </div>
                                    <div class="dropdown-content">
                                        <ul class="friend-list">
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <img src="{{asset('user_assets/images/user-sm/1.jpg')}}" alt="user">
                                                        <div class="media-body">
                                                            <div>
                                                                <h5 class="mt-0">Paige Turner</h5>
                                                                <h6>Are you there ?</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="active-status">
                                                        <span class="active"></span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <img src="{{asset('user_assets/images/user-sm/2.jpg')}}" alt="user">
                                                        <div class="media-body">
                                                            <div>
                                                                <h5 class="mt-0">Paige Turner</h5>
                                                                <h6>Are you there ?</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <img src="{{asset('user_assets/images/user-sm/3.jpg')}}" alt="user">
                                                        <div class="media-body">
                                                            <div>
                                                                <h5 class="mt-0">Bob Frapples</h5>
                                                                <h6>hello ! how are you ?</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="active-status">
                                                        <span class="offline"></span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- dark/light -->
                            <li class="header-btn custom-dropdown">
                                <a class="main-link" href="javascript:void(0)">
                                    <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="moon"></i>
                                </a>
                                <a class="main-link d-none" href="javascript:void(0)">
                                    <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="sun"></i>
                                </a>
                            </li>
                            <!-- mobile app button -->
                            <li class="header-btn custom-dropdown d-md-none d-block app-btn">
                                <a class="main-link" href="javascript:void(0)">
                                    <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="grid"></i>
                                </a>
                                <div class="overlay-bg app-overlay"></div>
                                <div class="app-box">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="index.html">
                                                    <div class="icon">
                                                        <i data-feather="file" class="bar-icon"></i>
                                                    </div>
                                                    <h5>Newsfeed</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="single-page.html">
                                                    <div class="icon">
                                                        <i data-feather="star" class="bar-icon"></i>
                                                    </div>
                                                    <h5>favourite</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="#">
                                                    <div class="icon">
                                                        <i data-feather="users" class="bar-icon"></i>
                                                    </div>
                                                    <h5>group</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="music.html">
                                                    <div class="icon">
                                                        <i data-feather="headphones" class="bar-icon"></i>
                                                    </div>
                                                    <h5>music</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="weather.html">
                                                    <div class="icon">
                                                        <i data-feather="cloud" class="bar-icon"></i>
                                                    </div>
                                                    <h5>weather</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="event.html">
                                                    <div class="icon">
                                                        <i data-feather="calendar" class="bar-icon"></i>
                                                    </div>
                                                    <h5>calender</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="#">
                                                    <div class="icon">
                                                        <svg class="bar-icon">
                                                            <use class="fill-color"
                                                                xlink:href="{{asset('user_assets/svg/icons.svg#cake')}}"></use>
                                                        </svg>
                                                    </div>
                                                    <h5>event</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="games.html">
                                                    <div class="icon">
                                                        <svg class="bar-icon">
                                                            <use class="fill-color"
                                                                xlink:href="{{asset('user_assets/svg/icons.svg#game-controller')}}">
                                                            </use>
                                                        </svg>
                                                    </div>
                                                    <h5>games</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- notification -->
                            <li class="header-btn custom-dropdown dropdown-lg btn-group notification-btn">
                                <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="bell"></i><span
                                        class="count warning">2</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-header">
                                        <span>Notification</span>
                                        <div class="mobile-close">
                                            <h5>close</h5>
                                        </div>
                                    </div>
                                    <div class="dropdown-content">
                                        <ul class="friend-list">
                                            <li class="d-block">
                                                <div>
                                                    <div class="media">
                                                        <img src="{{asset('user_assets/images/user-sm/5.jpg')}}" alt="user">
                                                        <div class="media-body">
                                                            <div>
                                                                <h5 class="mt-0"><span>Paige Turner</span> send you a
                                                                    friend request
                                                                </h5>
                                                                <h6> 1 mutual friend</h6>
                                                                <div class="action-btns">
                                                                    <button type="button" class="btn btn-solid"><i
                                                                            data-feather="check"></i></button>
                                                                    <button type="button" class="btn btn-solid ms-1"><i
                                                                            data-feather="x"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <img src="{{asset('user_assets/images/user-sm/6.jpg')}}" alt="user">
                                                        <div class="media-body">
                                                            <div>
                                                                <h5 class="mt-0"><span>Bob Frapples</span> add their
                                                                    stories
                                                                </h5>
                                                                <h6>8 hour ago</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <img src="{{asset('user_assets/images/user-sm/7.jpg')}}" alt="user">
                                                        <div class="media-body">
                                                            <div>
                                                                <h5 class="mt-0"><span>Josephin water</span> have
                                                                    birthday today
                                                                </h5>
                                                                <h6>sun at 5.55 AM</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <img src="{{asset('user_assets/images/user-sm/2.jpg')}}" alt="user">
                                                        <div class="media-body">
                                                            <div>
                                                                <h5 class="mt-0"><span>Petey Cruiser</span> added a new
                                                                    photo
                                                                </h5>
                                                                <h6>sun at 5.40 AM</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <!-- profile -->
                            <li class="header-btn custom-dropdown profile-btn btn-group">
                                <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-light stroke-width-3 d-sm-none d-block iw-16 ih-16"
                                        data-feather="user"></i>
                                    <div class="media d-none d-sm-flex">
                                        <div class="user-img">
                                            <img src="{{asset('user_assets/images/user-sm/1.jpg')}}"
                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                            <span class="available-stats online"></span>
                                        </div>
                                        <div class="media-body d-none d-md-block">
                                            <h4>Josephin water</h4>
                                            <span>active now</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-header">
                                        <span>profile</span>
                                        <div class="mobile-close">
                                            <h5>close</h5>
                                        </div>
                                    </div>
                                    <div class="dropdown-content">
                                        <ul class="friend-list">
                                            <li>
                                                <a href="profile.html">
                                                    <div class="media">
                                                        <i data-feather="user"></i>
                                                        <div class="media-body">
                                                            <div>
                                                                <h5 class="mt-0">Profile</h5>
                                                                <h6>Profile preview & settings</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="settings.html">
                                                    <div class="media">
                                                        <i data-feather="settings"></i>
                                                        <div class="media-body">
                                                            <div>
                                                                <h5 class="mt-0">setting & privacy</h5>
                                                                <h6>all settings & privacy</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="help-support.html">
                                                    <div class="media">
                                                        <i data-feather="help-circle"></i>
                                                        <div class="media-body">
                                                            <div>
                                                                <h5 class="mt-0">help & support</h5>
                                                                <h6>browse help here</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="login.html">
                                                    <div class="media">
                                                        <i data-feather="log-out"></i>
                                                        <div class="media-body">
                                                            <div>
                                                                <h5 class="mt-0">log out</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div class="page-body container-fluid custom-padding">

            <!-- sidebar panel start -->
            <div class="sidebar-panel">
                <div class="main-icon">
                    <a href="#">
                        <i data-feather="grid" class="bar-icon"></i>
                    </a>
                </div>
                <ul class="sidebar-icon">
                    <li>
                        <a href="index.html" class="tippy" title="Newsfeed">
                            <i data-feather="file" class="bar-icon"></i>
                        </a>
                    </li>
                    <li>
                        <a href="single-page.html" class="tippy" title="Favourite">
                            <i data-feather="star" class="bar-icon"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tippy" title="Groups">
                            <i data-feather="users" class="bar-icon"></i>
                        </a>
                    </li>
                    <li>
                        <a href="music.html" class="tippy" title="Music">
                            <i data-feather="headphones" class="bar-icon"></i>
                        </a>
                    </li>
                    <li>
                        <a href="weather.html" class="tippy" title="Weather">
                            <i data-feather="cloud" class="bar-icon"></i>
                        </a>
                    </li>
                    <li>
                        <a href="event.html" class="tippy" title="Event & Calender">
                            <i data-feather="calendar" class="bar-icon"></i>
                        </a>
                    </li>
                </ul>
                <div class="main-icon">
                    <a href="#">
                        <i data-feather="power" class="bar-icon"></i>
                    </a>
                </div>
            </div>
            <!-- sidebar panel end -->


            <div class="page-center">

                <!-- stroy section start -->
                <div class="story-section ratio_115">
                    <div class="slide-8 no-arrow default-space">
                        <div>
                            <div class="story-box">
                                <div class="story-bg bg-size">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="story-box">
                                <div class="story-bg bg-size">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="story-box">
                                <div class="story-bg bg-size">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="story-box">
                                <div class="story-bg bg-size">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="story-box">
                                <div class="story-bg bg-size">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="story-box">
                                <div class="story-bg bg-size">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="story-box">
                                <div class="story-bg bg-size">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="story-box">
                                <div class="story-bg bg-size">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- stroy section end -->

                <div class="container-fluid section-t-space px-0 layout-default">
                    <div class="page-content">
                        <div class="content-left">
                            <!-- profile box -->
                            <div class="profile-box">
                                <div class="profile-content">
                                    <a href="profile.html" class="image-section">
                                        <div class="profile-img">
                                            <div class="bg-loader"></div>
                                        </div>
                                    </a>
                                    <div class="profile-detail">
                                        <h2></h2>
                                        <h5></h5>
                                        <div class="description">
                                            <p></p>
                                            <p></p>
                                        </div>
                                        <div class="counter-stats">
                                            <span></span>
                                        </div>
                                        <div class="ldr-btn btn"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- suggestion box -->
                            <div class="suggestion-box section-t-space">
                                <div class="card-title">
                                    <h3></h3>
                                </div>
                                <div class="suggestion-content ratio_115">
                                    <div class="slide-2 no-arrow default-space">
                                        <div>
                                            <div class="story-box">
                                                <div class="story-bg bg-size">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="story-box">
                                                <div class="story-bg bg-size">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- like page -->
                            <div class="page-list section-t-space">
                                <div class="card-title">
                                    <h3></h3>
                                </div>
                                <div class="list-content">
                                    <ul>
                                        <li>
                                            <div class="media">
                                                <div class="img-part">
                                                </div>
                                                <div class="media-body">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="img-part">
                                                </div>
                                                <div class="media-body">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="img-part">
                                                </div>
                                                <div class="media-body">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="img-part">
                                                </div>
                                                <div class="media-body">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="img-part">
                                                </div>
                                                <div class="media-body">
                                                    <h4></h4>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="content-center">
                            <!-- create post -->
                            <div class="create-post">
                                <div class="static-section">
                                    <div class="card-title">
                                        <h3></h3>
                                    </div>
                                    <div class="search-input input-style icon-right">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="create-bg">
                                    <div class="bg-post">
                                        <div class="input-sec">
                                            <input type="text" class="form-control enable"
                                                placeholder="write something here..">
                                            <div class="close-icon">
                                                <a href="javascript:void(0)">
                                                    <i class="iw-20 ih-20" data-feather="x"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gradient-bg">
                                    </div>
                                </div>
                                <ul class="create-btm-option">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                                <div class="post-btn">
                                    <button disabled="disabled" class="Disable">post</button>
                                </div>
                            </div>
                            <div class="overlay-bg"></div>
                            <div class="post-panel section-t-space">
                                <div class="post-wrapper col-grid-box">
                                    <div class="post-title">
                                        <div class="profile">
                                            <div class="media">
                                                <div class="user-img">
                                                </div>
                                                <div class="media-body">
                                                    <h5></h5>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-details ratio2_1">
                                        <div class="img-wrapper bg-size">
                                        </div>
                                        <div class="detail-box">
                                            <h3></h3>
                                            <h5 class="tag"></h5>
                                            <div class="ldr-p">
                                                <p></p>
                                                <p></p>
                                            </div>
                                            <div class="bookmark favourite-btn">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-wrapper col-grid-box section-t-space">
                                    <div class="post-title">
                                        <div class="profile">
                                            <div class="media">
                                                <div class="user-img">
                                                </div>
                                                <div class="media-body">
                                                    <h5></h5>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-details ratio2_1">
                                        <div class="img-wrapper bg-size">
                                        </div>
                                        <div class="detail-box">
                                            <h3></h3>
                                            <h5 class="tag"></h5>
                                            <div class="ldr-p">
                                                <p></p>
                                                <p></p>
                                            </div>
                                            <div class="bookmark favourite-btn">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-right">
                            <!-- birthday reminder -->
                            <div class="birthday-section bg-size">
                                <div class="birthday-top">
                                    <div class="title">
                                        <h3></h3>
                                        <h6></h6>
                                    </div>
                                </div>
                                <div class="birthday-content">
                                    <div class="image-section">
                                        <div class="icon">
                                        </div>
                                        <div class="center-profile">
                                        </div>
                                        <div class="icon">
                                        </div>
                                    </div>
                                    <div class="details">
                                        <h3></h3>
                                        <h6></h6>
                                        <div class="ldr-p">
                                            <p></p>
                                            <p></p>
                                        </div>
                                        <form>
                                            <input type="text" class="form-control">
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- gallery section -->
                            <div class="gallery-section section-t-space">
                                <div class="gallery-top">
                                    <div class="card-title">
                                        <h3></h3>
                                    </div>
                                </div>
                                <div class="portfolio-section ratio_square">
                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="overlay">
                                                    <div class="portfolio-image bg-size">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="overlay">
                                                    <div class="portfolio-image bg-size">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="overlay">
                                                    <div class="portfolio-image bg-size">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 row m-0">
                                                <div class="col-12 pt-cls p-0">
                                                    <div class="overlay">
                                                        <div class="portfolio-image bg-size">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 pt-cls p-0">
                                                    <div class="overlay">
                                                        <div class="portfolio-image bg-size">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-8 pt-cls">
                                                <div class="overlay">
                                                    <div class="portfolio-image bg-size">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- suggestion box -->
                            <div class="suggestion-box section-t-space">
                                <div class="card-title">
                                    <h3></h3>
                                </div>
                                <div class="suggestion-content ratio_115">
                                    <div class="slide-2 no-arrow default-space">
                                        <div>
                                            <div class="story-box">
                                                <div class="story-bg bg-size">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="story-box">
                                                <div class="story-bg bg-size">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- loader end -->


    <!-- header start -->
    <header>
        <div class="mobile-fix-menu"></div>
        <div class="container-fluid custom-padding">
            <div class="header-section">
                <div class="header-left">
                    <div class="brand-logo">
                        <a href="index.html">
                            <img src="{{ asset('admin_assets/images/logos/logo.png') }}" alt="logo" class="img-fluid blur-up lazyload">
                        </a>
                    </div>
                    <div class="search-box">
                        <i data-feather="search" class="icon iw-16 icon-light"></i>
                        <input type="text" class="form-control search-type" placeholder="find friends...">
                        <div class="icon-close">
                            <i data-feather="x" class="iw-16 icon-light"></i>
                        </div>
                        <div class="search-suggestion">
                            <span class="recent">recent search</span>
                            <ul class="friend-list">
                                <li>
                                    <div class="media">
                                        <img src="{{asset('user_assets/images/user-sm/9.jpg')}}" alt="user">
                                        <div class="media-body">
                                            <div>
                                                <h5 class="mt-0">Paige Turner</h5>
                                                <h6> 1 mutual friend</h6>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img src="{{asset('user_assets/images/user-sm/12.jpg')}}" alt="user">
                                        <div class="media-body">
                                            <div>
                                                <h5 class="mt-0">Paige Turner</h5>
                                                <h6> 1 mutual friend</h6>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img src="{{asset('user_assets/images/user-sm/15.jpg')}}" alt="user">
                                        <div class="media-body">
                                            <div>
                                                <h5 class="mt-0">Paige Turner</h5>
                                                <h6> 1 mutual friend</h6>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="btn-group">
                        <!-- home -->
                        <li class="header-btn home-btn">
                            <a class="main-link" href="index.html">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="home"></i>
                            </a>
                        </li>
                        <!-- add friend -->
                        <li class="header-btn custom-dropdown dropdown-lg add-friend">
                            <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="user-plus"></i>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-header">
                                    <span>friend request</span>
                                    <div class="mobile-close">
                                        <h5>close</h5>
                                    </div>
                                </div>
                                <div class="dropdown-content">
                                    <ul class="friend-list">
                                        <li>
                                            <div class="media">
                                                <img src="{{asset('user_assets/images/user-sm/5.jpg')}}" alt="user">
                                                <div class="media-body">
                                                    <div>
                                                        <h5 class="mt-0">Paige Turner</h5>
                                                        <h6> 1 mutual friend</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action-btns">
                                                <button type="button" class="btn btn-solid">confirm</button>
                                                <button type="button" class="btn btn-outline ms-1">delete</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img src="{{asset('user_assets/images/user-sm/6.jpg')}}" alt="user">
                                                <div class="media-body">
                                                    <div>
                                                        <h5 class="mt-0">Paige Turner</h5>
                                                        <h6> 1 mutual friend</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action-btns">
                                                <button type="button" class="btn btn-solid">confirm</button>
                                                <button type="button" class="btn btn-outline ms-1">delete</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img src="{{asset('user_assets/images/user-sm/7.jpg')}}" alt="user">
                                                <div class="media-body">
                                                    <div>
                                                        <h5 class="mt-0">Paige Turner</h5>
                                                        <h6> 1 mutual friend</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action-btns">
                                                <button type="button" class="btn btn-solid">confirm</button>
                                                <button type="button" class="btn btn-outline ms-1">delete</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img src="{{asset('user_assets/images/user-sm/2.jpg')}}" alt="user">
                                                <div class="media-body">
                                                    <div>
                                                        <h5 class="mt-0">Paige Turner</h5>
                                                        <h6> 1 mutual friend</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action-btns">
                                                <button type="button" class="btn btn-solid">confirm</button>
                                                <button type="button" class="btn btn-outline ms-1">delete</button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="header-right">
                    <div class="post-stats">
                        <ul>
                            <li>
                                <h3>326</h3>
                                <span>total posts</span>
                            </li>
                            <li>
                                <h3>2456</h3>
                                <span>total friends</span>
                            </li>
                        </ul>
                    </div>
                    <ul class="option-list">
                        <!-- message -->
                        <li class="header-btn custom-dropdown dropdown-lg btn-group message-btn">
                            <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="message-circle"></i><span
                                    class="count success">2</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header">
                                    <div class="left-title">
                                        <span>messages</span>
                                    </div>
                                    <div class="right-option">
                                        <ul>
                                            <li>
                                                <a href="messanger.html">
                                                    <i class="iw-16 ih-16" data-feather="maximize"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="iw-16 ih-16" data-feather="edit"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="iw-16 ih-16" data-feather="more-horizontal"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mobile-close">
                                        <h5>close</h5>
                                    </div>
                                </div>
                                <div class="search-bar input-style icon-left">
                                    <i class="iw-16 ih-16 icon" data-feather="search"></i>
                                    <input type="text" class="form-control" placeholder="search messages...">
                                </div>
                                <div class="dropdown-content">
                                    <ul class="friend-list">
                                        <li>
                                            <a href="#">
                                                <div class="media">
                                                    <img src="{{asset('user_assets/images/user-sm/1.jpg')}}" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">Paige Turner</h5>
                                                            <h6>Are you there ?</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="active-status">
                                                    <span class="active"></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="media">
                                                    <img src="{{asset('user_assets/images/user-sm/2.jpg')}}" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">Paige Turner</h5>
                                                            <h6>Are you there ?</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="media">
                                                    <img src="{{asset('user_assets/images/user-sm/3.jpg')}}" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">Bob Frapples</h5>
                                                            <h6>hello ! how are you ?</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="active-status">
                                                    <span class="offline"></span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- dark/light -->
                        <li class="header-btn custom-dropdown">
                            <a id="dark" class="main-link" href="javascript:void(0)">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="moon"></i>
                            </a>
                            <a id="light" class="main-link d-none" href="javascript:void(0)">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="sun"></i>
                            </a>
                        </li>
                        <!-- mobile app button -->
                        <li class="header-btn custom-dropdown d-md-none d-block app-btn">
                            <a class="main-link" href="javascript:void(0)">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="grid"></i>
                            </a>
                            <div class="overlay-bg app-overlay"></div>
                            <div class="app-box">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="index.html">
                                                <div class="icon">
                                                    <i data-feather="file" class="bar-icon"></i>
                                                </div>
                                                <h5>Newsfeed</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="single-page.html">
                                                <div class="icon">
                                                    <i data-feather="star" class="bar-icon"></i>
                                                </div>
                                                <h5>favourite</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="#">
                                                <div class="icon">
                                                    <i data-feather="users" class="bar-icon"></i>
                                                </div>
                                                <h5>group</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="music.html">
                                                <div class="icon">
                                                    <i data-feather="headphones" class="bar-icon"></i>
                                                </div>
                                                <h5>music</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="weather.html">
                                                <div class="icon">
                                                    <i data-feather="cloud" class="bar-icon"></i>
                                                </div>
                                                <h5>weather</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="event.html">
                                                <div class="icon">
                                                    <i data-feather="calendar" class="bar-icon"></i>
                                                </div>
                                                <h5>calender</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="#">
                                                <div class="icon">
                                                    <svg class="bar-icon">
                                                        <use class="fill-color"
                                                            xlink:href="{{asset('user_assets/svg/icons.svg#cake')}}"></use>
                                                    </svg>
                                                </div>
                                                <h5>event</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="games.html">
                                                <div class="icon">
                                                    <svg class="bar-icon">
                                                        <use class="fill-color"
                                                            xlink:href="{{asset('user_assets/svg/icons.svg#game-controller')}}">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <h5>games</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- notification -->
                        <li class="header-btn custom-dropdown dropdown-lg btn-group notification-btn">
                            <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="bell"></i><span
                                    class="count warning">2</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header">
                                    <span>Notification</span>
                                    <div class="mobile-close">
                                        <h5>close</h5>
                                    </div>
                                </div>
                                <div class="dropdown-content">
                                    <ul class="friend-list">
                                        <li class="d-block">
                                            <div>
                                                <div class="media">
                                                    <img src="{{asset('user_assets/images/user-sm/5.jpg')}}" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0"><span>Paige Turner</span> send you a friend
                                                                request
                                                            </h5>
                                                            <h6> 1 mutual friend</h6>
                                                            <div class="action-btns">
                                                                <button type="button" class="btn btn-solid"><i
                                                                        data-feather="check"></i></button>
                                                                <button type="button" class="btn btn-solid ms-1"><i
                                                                        data-feather="x"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="media">
                                                    <img src="{{asset('user_assets/images/user-sm/6.jpg')}}" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0"><span>Bob Frapples</span> add their stories
                                                            </h5>
                                                            <h6>8 hour ago</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="media">
                                                    <img src="{{asset('user_assets/images/user-sm/7.jpg')}}" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0"><span>Josephin water</span> have birthday
                                                                today
                                                            </h5>
                                                            <h6>sun at 5.55 AM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="media">
                                                    <img src="{{asset('user_assets/images/user-sm/2.jpg')}}" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0"><span>Petey Cruiser</span> added a new
                                                                photo
                                                            </h5>
                                                            <h6>sun at 5.40 AM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- profile -->
                        <li class="header-btn custom-dropdown profile-btn btn-group">
                            <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-light stroke-width-3 d-sm-none d-block iw-16 ih-16"
                                    data-feather="user"></i>
                                <div class="media d-none d-sm-flex">
                                    <div class="user-img">
                                        <img src="{{asset('user_assets/images/user-sm/1.jpg')}}"
                                            class="img-fluid blur-up lazyload bg-img" alt="user">
                                        <span class="available-stats online"></span>
                                    </div>
                                    <div class="media-body d-none d-md-block">
                                        <h4>Josephin water</h4>
                                        <span>active now</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header">
                                    <span>profile</span>
                                    <div class="mobile-close">
                                        <h5>close</h5>
                                    </div>
                                </div>
                                <div class="dropdown-content">
                                    <ul class="friend-list">
                                        <li>
                                            <a href="profile.html">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">Profile</h5>
                                                            <h6>Profile preview & settings</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="settings.html">
                                                <div class="media">
                                                    <i data-feather="settings"></i>
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">setting & privacy</h5>
                                                            <h6>all settings & privacy</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="help-support.html">
                                                <div class="media">
                                                    <i data-feather="help-circle"></i>
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">help & support</h5>
                                                            <h6>browse help here</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="login.html">
                                                <div class="media">
                                                    <i data-feather="log-out"></i>
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">log out</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->


    <!-- page body start -->
    <div class="page-body container-fluid custom-padding">

        <!-- sidebar panel start -->
        <div class="sidebar-panel">
            <div class="main-icon">
                <a href="#">
                    <i data-feather="grid" class="bar-icon"></i>
                </a>
            </div>
            <ul class="sidebar-icon">
                <li>
                    <a href="index.html">
                        <i data-feather="file" class="bar-icon"></i>
                        <div class="tooltip-cls">
                            <span>newsfeed</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="single-page.html">
                        <i data-feather="star" class="bar-icon"></i>
                        <div class="tooltip-cls">
                            <span>Favourite</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i data-feather="users" class="bar-icon"></i>
                        <div class="tooltip-cls">
                            <span>Groups</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="music.html">
                        <i data-feather="headphones" class="bar-icon"></i>
                        <div class="tooltip-cls">
                            <span>Music</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="weather.html">
                        <i data-feather="cloud" class="bar-icon"></i>
                        <div class="tooltip-cls">
                            <span>Weather</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="event.html">
                        <i data-feather="calendar" class="bar-icon"></i>
                        <div class="tooltip-cls">
                            <span>Event</span>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="main-icon">
                <a href="#">
                    <i data-feather="power" class="bar-icon"></i>
                </a>
            </div>
        </div>
        <!-- sidebar panel end -->


        <div class="page-center">

            <!-- stroy section start -->
            <div class="story-section ratio_115">
                <div class="slide-8 no-arrow default-space">
                    <div>
                        <div class="story-box add-box">
                            <div>
                                <img src="../user_assets/images/story-bg.jpg" class="img-fluid blur-up lazyload bg-img"
                                    alt="">
                                <div class="add-icon">
                                    <div class="icon">
                                        <img src="../user_assets/images/icon/plus.png" class="img-fluid blur-up lazyload"
                                            alt="plus">
                                    </div>
                                    <h6>add stories</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="story-box" data-bs-toggle="modal" data-bs-target="#storyModel">
                            <div class="adaptive-overlay orange-overlay"></div>
                            <div class="story-bg">
                                <img src="../user_assets/images/story/6.jpg" class="img-fluid bg-img"
                                    data-adaptive-background='1' alt="">
                            </div>
                            <div class="story-content">
                                <h6>Anna Mull</h6>
                                <span>active now</span>
                            </div>
                            <div class="story-setting setting-dropdown">
                                <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-light iw-13 ih-13" data-feather="sun"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                        <ul>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="volume-x"></i>mute josephin</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="user"></i>view profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="story-box" data-bs-toggle="modal" data-bs-target="#storyModel">
                            <div class="adaptive-overlay pink-overlay"></div>
                            <div class="story-bg">
                                <img src="../user_assets/images/story/2.jpg" class="img-fluid bg-img"
                                    data-adaptive-background='1' alt="">
                            </div>
                            <div class="story-content">
                                <h6>josephin water</h6>
                                <span>active now</span>
                            </div>
                            <div class="story-setting setting-dropdown">
                                <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-light iw-13 ih-13" data-feather="sun"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                        <ul>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="volume-x"></i>mute josephin</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="user"></i>view profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="story-box" data-bs-toggle="modal" data-bs-target="#storyModel">
                            <div class="adaptive-overlay skin-overlay"></div>
                            <div class="story-bg">
                                <img src="../user_assets/images/story/1.jpg" class="img-fluid bg-img"
                                    data-adaptive-background='1' alt="">
                            </div>
                            <div class="story-content">
                                <h6>josephin water</h6>
                                <span>active now</span>
                            </div>
                            <div class="story-setting setting-dropdown">
                                <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-light iw-13 ih-13" data-feather="sun"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                        <ul>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="volume-x"></i>mute josephin</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="user"></i>view profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="story-box" data-bs-toggle="modal" data-bs-target="#storyModel">
                            <div class="adaptive-overlay yellow-overlay"></div>
                            <div class="story-bg">
                                <img src="../user_assets/images/story/3.jpg" class="img-fluid bg-img"
                                    data-adaptive-background='1' alt="">
                            </div>
                            <div class="story-content">
                                <h6>Petey Cruiser</h6>
                                <span>active now</span>
                            </div>
                            <div class="story-setting setting-dropdown">
                                <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-light iw-13 ih-13" data-feather="sun"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                        <ul>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="volume-x"></i>mute josephin</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="user"></i>view profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="story-box" data-bs-toggle="modal" data-bs-target="#storyModel">
                            <div class="adaptive-overlay skin-overlay"></div>
                            <div class="story-bg">
                                <img src="../user_assets/images/story/5.jpg" class="img-fluid bg-img"
                                    data-adaptive-background='1' alt="">
                            </div>
                            <div class="story-content">
                                <h6>Paul Molive</h6>
                                <span>active now</span>
                            </div>
                            <div class="story-setting setting-dropdown">
                                <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-light iw-13 ih-13" data-feather="sun"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                        <ul>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="volume-x"></i>mute josephin</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="user"></i>view profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="story-box" data-bs-toggle="modal" data-bs-target="#storyModel">
                            <div class="adaptive-overlay pink-overlay"></div>
                            <div class="story-bg">
                                <img src="../user_assets/images/story/4.jpg" class="img-fluid bg-img"
                                    data-adaptive-background='1' alt="">
                            </div>
                            <div class="story-content">
                                <h6>Anna Sthesia</h6>
                                <span>active now</span>
                            </div>
                            <div class="story-setting setting-dropdown">
                                <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-light iw-13 ih-13" data-feather="sun"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                        <ul>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="volume-x"></i>mute josephin</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="user"></i>view profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="story-box" data-bs-toggle="modal" data-bs-target="#storyModel">
                            <div class="adaptive-overlay blue-overlay"></div>
                            <div class="story-bg">
                                <img src="../user_assets/images/story/7.jpg" class="img-fluid bg-img"
                                    data-adaptive-background='1' alt="">
                            </div>
                            <div class="story-content">
                                <h6>Paige Turner</h6>
                                <span>active now</span>
                            </div>
                            <div class="story-setting setting-dropdown">
                                <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-light iw-13 ih-13" data-feather="sun"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                        <ul>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="volume-x"></i>mute josephin</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="user"></i>view profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="story-box" data-bs-toggle="modal" data-bs-target="#storyModel">
                            <div class="adaptive-overlay"></div>
                            <div class="story-bg">
                                <img src="../user_assets/images/story/8.jpg" class="img-fluid bg-img"
                                    data-adaptive-background='1' alt="">
                            </div>
                            <div class="story-content">
                                <h6>Bob Frapples</h6>
                                <span>active now</span>
                            </div>
                            <div class="story-setting setting-dropdown">
                                <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-light iw-13 ih-13" data-feather="sun"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                        <ul>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="volume-x"></i>mute josephin</a>
                                            </li>
                                            <li>
                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                        data-feather="user"></i>view profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- stroy section end -->

            <div class="container-fluid section-t-space px-0 layout-default">
                <div class="page-content">
                    <div class="content-left">
                        <!-- profile box -->
                        <div class="profile-box">
                            <div class="profile-setting">
                                <div class="setting-btn refresh">
                                    <a href="#" class="d-flex">
                                        <i class="icon icon-theme stroke-width-3 iw-11 ih-11"
                                            data-feather="rotate-cw"></i>
                                    </a>
                                </div>
                                <div class="setting-btn setting setting-dropdown">
                                    <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                        <a href="#" class="d-flex" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="icon icon-theme stroke-width-3 iw-11 ih-11"
                                                data-feather="sun"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                            <ul>
                                                <li>
                                                    <a href=""><i class="icon-font-light iw-16 ih-16"
                                                            data-feather="edit"></i>edit profile</a>
                                                </li>
                                                <li>
                                                    <a href=""><i class="icon-font-light iw-16 ih-16"
                                                            data-feather="user"></i>view profile</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-content">
                                <a href="profile.html" class="image-section">
                                    <div class="profile-img">
                                        <div>
                                            <img src="../user_assets/images/story/8.jpg"
                                                class="img-fluid blur-up lazyload bg-img" alt="profile">
                                        </div>
                                        <span class="stats">
                                            <img src="../user_assets/images/icon/verified.png"
                                                class="img-fluid blur-up lazyload" alt="verified">
                                        </span>
                                    </div>
                                </a>
                                <div class="profile-detail">
                                    <a href="profile.html">
                                        <h2>kelin jasen <span>❤</span></h2>
                                    </a>
                                    <h5>kelin.jasen156@gmail.com</h5>
                                    <div class="description">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        </p>
                                    </div>
                                    <div class="counter-stats">
                                        <ul id="counter">
                                            <li>
                                                <h3 class="counter-value" data-count="546">0</h3>
                                                <h5>following</h5>
                                            </li>
                                            <li>
                                                <h3 class="counter-value" data-count="26335">0</h3>
                                                <h5>likes</h5>
                                            </li>
                                            <li>
                                                <h3 class="counter-value" data-count="6845">0</h3>
                                                <h5>followers</h5>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="#" class="btn btn-solid">view profile</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="sticky-top">
                            <!-- like page -->
                            <div class="page-list section-t-space">
                                <div class="card-title">
                                    <h3>liked pages</h3>
                                    <h5>18 pages</h5>
                                    <div class="settings">
                                        <div class="setting-btn">
                                            <a href="#" class="d-flex">
                                                <i class="icon icon-dark stroke-width-3 iw-11 ih-11"
                                                    data-feather="rotate-cw"></i>
                                            </a>
                                        </div>
                                        <div class="setting-btn ms-2 setting-dropdown">
                                            <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                                <a href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="icon-dark stroke-width-3 icon iw-11 ih-11"
                                                        data-feather="sun"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                                    <ul>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="edit"></i>see all</a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="search"></i>find
                                                                page</a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="settings"></i>settings</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-content">
                                    <ul>
                                        <li>
                                            <div class="media">
                                                <div class="img-part">
                                                    <img src="../user_assets/images/pages-logo/1.jpg"
                                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <h4>chrimson agency</h4>
                                                    <h6>clothing store
                                                        <span><i data-feather="user"
                                                                class="icon-font-color iw-13 ih-13"></i>15k</span>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="favourite-btn active">
                                                <i data-feather="star" class="icon-dark iw-14 ih-14"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="img-part">
                                                    <img src="../user_assets/images/pages-logo/2.jpg"
                                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <h4>Digital Pixel</h4>
                                                    <h6>software company
                                                        <span><i data-feather="user"
                                                                class="icon-font-color iw-13 ih-13"></i>158k</span>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="favourite-btn">
                                                <i data-feather="star" class="icon-dark iw-14 ih-14"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="img-part">
                                                    <img src="../user_assets/images/pages-logo/3.jpg"
                                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <h4>the angle bar</h4>
                                                    <h6>disco bar
                                                        <span><i data-feather="user"
                                                                class="icon-font-color iw-13 ih-13"></i>8k</span>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="favourite-btn active">
                                                <i data-feather="star" class="icon-dark iw-14 ih-14"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="img-part">
                                                    <img src="../user_assets/images/pages-logo/4.jpg"
                                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <h4>fivestar food</h4>
                                                    <h6>restaurant
                                                        <span><i data-feather="user"
                                                                class="icon-font-color iw-13 ih-13"></i>186k</span>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="favourite-btn">
                                                <i data-feather="star" class="icon-dark iw-14 ih-14"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="img-part">
                                                    <img src="../user_assets/images/pages-logo/5.jpg"
                                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <h4>royal watch</h4>
                                                    <h6>watch shop
                                                        <span><i data-feather="user"
                                                                class="icon-font-color iw-13 ih-13"></i>65k</span>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="favourite-btn">
                                                <i data-feather="star" class="icon-dark iw-14 ih-14"></i>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- weather section -->
                            <div class="weather-section section-t-space">
                                <div class="card-title light-version">
                                    <h3>weather</h3>
                                    <div class="settings">
                                        <div class="setting-btn light-btn">
                                            <a href="#" class="d-flex">
                                                <i class="icon icon-light stroke-width-3 iw-11 ih-11"
                                                    data-feather="rotate-cw"></i>
                                            </a>
                                        </div>
                                        <div class="setting-btn light-btn ms-2 setting-dropdown">
                                            <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                                <a class="d-flex" href="#" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-light stroke-width-3 iw-12 ih-12"
                                                        data-feather="sun"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                                    <ul>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="edit"></i>change
                                                                city</a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="settings"></i>setting</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="weather-content">
                                    <div class="top-title">
                                        <h2>28°C</h2>
                                        <h5>4.45 pm</h5>
                                    </div>
                                    <h5>sunny day</h5>
                                    <h6>21 march 2021 (monday) <span>denmark</span></h6>
                                </div>
                                <div class="flaks-img">
                                    <img src="../user_assets/images/icon/snow-flaks.png" class="img-fluid blur-up lazyload"
                                        alt="snow">
                                </div>
                                <div class="snowflakes" aria-hidden="true">
                                    <div class="snowflake">
                                        ❅
                                    </div>
                                    <div class="snowflake">
                                        ❆
                                    </div>
                                    <div class="snowflake">
                                        ❅
                                    </div>
                                    <div class="snowflake">
                                        ❆
                                    </div>
                                    <div class="snowflake">
                                        ❅
                                    </div>
                                    <div class="snowflake">
                                        ❆
                                    </div>
                                    <div class="snowflake">
                                        ❅
                                    </div>
                                    <div class="snowflake">
                                        ❆
                                    </div>
                                    <div class="snowflake">
                                        ❅
                                    </div>
                                    <div class="snowflake">
                                        ❆
                                    </div>
                                    <div class="snowflake">
                                        ❅
                                    </div>
                                    <div class="snowflake">
                                        ❆
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-center">
                        <!-- create post -->
                        <div class="create-post">
                            <div class="static-section">
                                <div class="card-title">
                                    <h3>create post</h3>
                                    <ul class="create-option">
                                        <li class="options">
                                            <div class="setting-dropdown">
                                                <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                                    <h5 data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">public <i class="iw-14"
                                                            data-feather="chevron-down"></i></h5>
                                                    <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                                        <ul>
                                                            <li>
                                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                        data-feather="globe"></i>public</a>
                                                            </li>
                                                            <li>
                                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                        data-feather="users"></i>friends</a>
                                                            </li>
                                                            <li>
                                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                        data-feather="user"></i>friends
                                                                    except</a>
                                                            </li>
                                                            <li>
                                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                        data-feather="user"></i>specific
                                                                    friends</a>
                                                            </li>
                                                            <li>
                                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                        data-feather="lock"></i>only me</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <h5><i class="iw-15" data-feather="video"></i>go live</h5>
                                        </li>
                                    </ul>
                                    <div class="settings">
                                        <div class="setting-btn ms-2 setting-dropdown no-bg">
                                            <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                                <div role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="icon icon-font-color iw-14"
                                                        data-feather="more-horizontal"></i>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                                    <ul>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="edit"></i>edit
                                                                profile</a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="user"></i>view
                                                                profile</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="search-input input-style icon-right">
                                    <input type="text" class="form-control enable" placeholder="write something here..">
                                    <a href="#">
                                        <img src="../user_assets/images/icon/translate.png"
                                            class="img-fluid blur-up lazyload icon" alt="translate">
                                    </a>
                                </div>
                            </div>
                            <div class="create-bg">
                                <div class="bg-post" id="bg-post">
                                    <div class="input-sec">
                                        <input type="text" class="form-control enable"
                                            placeholder="write something here..">
                                        <div class="close-icon">
                                            <a href="javascript:void(0)">
                                                <i class="iw-20 ih-20" data-feather="x"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="gradient-bg">
                                    <li onclick="clickGradient( 'gr-1')" class="gr-1"></li>
                                    <li onclick="clickGradient( 'gr-2')" class="gr-2"></li>
                                    <li onclick="clickGradient( 'gr-3')" class="gr-3"></li>
                                    <li onclick="clickGradient( 'gr-4')" class="gr-4"></li>
                                    <li onclick="clickGradient( 'gr-5')" class="gr-5"></li>
                                    <li onclick="clickGradient( 'gr-6')" class="gr-6"></li>
                                    <li onclick="clickGradient( 'gr-7')" class="gr-7"></li>
                                    <li onclick="clickGradient( 'gr-8')" class="gr-8"></li>
                                    <li onclick="clickGradient( 'gr-9')" class="gr-9"></li>
                                    <li onclick="clickGradient( 'gr-10')" class="gr-10"></li>
                                    <li onclick="clickGradient( 'gr-11')" class="gr-11"></li>
                                    <li onclick="clickGradient( 'gr-12')" class="gr-12"></li>
                                    <li onclick="clickGradient( 'gr-13')" class="gr-13"></li>
                                    <li onclick="clickGradient( 'gr-14')" class="gr-14"></li>
                                    <li onclick="clickGradient( 'gr-15')" class="gr-15"></li>
                                </ul>
                            </div>
                            <div class="options-input" id="additional-input">
                                <a id="icon-close" href="javascript:void(0)">
                                    <i class="iw-15 icon-font-light icon-close" data-feather="x"></i>
                                </a>
                                <div class="search-input feeling-input">
                                    <input type="text" class="form-control enable" list="feelings"
                                        placeholder="How Are You Feeling?">
                                    <datalist id="feelings">
                                        <option value="Happy">
                                        <option value="Sad">
                                        <option value="Angry">
                                        <option value="Worried">
                                        <option value="Shy">
                                        <option value="Excited">
                                        <option value="Surprised">
                                        <option value="Silly">
                                        <option value="Embarrassed">
                                        </option>
                                    </datalist>
                                    <a href="#">
                                        <i class="iw-15 icon-left icon-font-light" data-feather="smile"></i>
                                    </a>
                                </div>
                                <div class="search-input place-input">
                                    <input type="text" class="form-control" placeholder="search for places...">
                                    <a href="#">
                                        <i class="iw-15 icon-left icon-font-light" data-feather="map-pin"></i>
                                    </a>
                                </div>
                                <div class="search-input friend-input">
                                    <input type="text" class="form-control" list="friends"
                                        placeholder="search your friends...">
                                    <datalist id="friends">
                                        <option value="Paige Turner">
                                        <option value="Bob Frapples">
                                        <option value="Josephin water">
                                        <option value="Petey Cruiser">
                                        <option value="Anna Sthesia">
                                        <option value="Paul Molive">
                                        <option value="Anna Mull">
                                        </option>
                                    </datalist>
                                    <a href="#">
                                        <i class="iw-15 icon-left icon-font-light" data-feather="tag"></i>
                                    </a>
                                </div>
                            </div>
                            <ul class="create-btm-option">
                                <li>
                                    <input class="choose-file" type="file">
                                    <h5><i class="iw-14" data-feather="camera"></i>album</h5>
                                </li>
                                <li id="feeling-btn">
                                    <h5><i class="iw-15" data-feather="smile"></i>feelings & acitivity</h5>
                                </li>
                                <li id="checkin-btn">
                                    <h5><i class="iw-15" data-feather="map-pin"></i>check in</h5>
                                </li>
                                <li id="friends-btn">
                                    <h5><i class="iw-15" data-feather="tag"></i>tag friends</h5>
                                </li>
                            </ul>
                            <div id="post-btn" class="post-btn">
                                <button disabled="disabled" class="Disable">post</button>
                            </div>
                        </div>
                        <div class="overlay-bg"></div>
                        <div class="post-panel infinite-loader-sec section-t-space">
                            <div class="post-wrapper col-grid-box">
                                <div class="post-title">
                                    <div class="profile">
                                        <div class="media">
                                            <a class="popover-cls user-img" data-bs-toggle="popover"
                                                data-placement="right" data-name="sufiya eliza"
                                                data-img="../user_assets/images/user-sm/1.jpg">
                                                <img src="../user_assets/images/user-sm/1.jpg"
                                                    class="img-fluid blur-up lazyload bg-img" alt="user">
                                            </a>
                                            <div class="media-body">
                                                <a href="#">
                                                    <h5>sufiya eliza</h5>
                                                </a>
                                                <h6>30 mins ago</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-btn ms-auto setting-dropdown no-bg">
                                        <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                            <div role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="icon icon-font-color iw-14"
                                                    data-feather="more-horizontal"></i>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                                <ul>
                                                    <li>
                                                        <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                data-feather="bookmark"></i>save post</a>
                                                    </li>
                                                    <li>
                                                        <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                data-feather="x-square"></i>hide post</a>
                                                    </li>
                                                    <li>
                                                        <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                data-feather="x-octagon"></i>unfollow sufiya</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-details">
                                    <div class="img-wrapper">
                                        <img src="../user_assets/images/post/1.jpg" class="img-fluid blur-up lazyload"
                                            alt="">
                                        <div class="controler">
                                            <a href="#" class="play" data-bs-toggle="modal"
                                                data-bs-target="#videoPlayer">
                                                <i class="iw-50 ih-50" data-feather="play-circle"></i>
                                            </a>
                                            <div class="duration">
                                                <h6>06:20</h6>
                                            </div>
                                            <a href="#" class="volume">
                                                <i class="iw-14 ih-14" data-feather="volume-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="detail-box">
                                        <h3>Today Our Three Cute Puppy Dog Birthday !!!!</h3>
                                        <h5 class="tag"><span>#ourcutepuppy,</span> #puppy, #birthday, #dog</h5>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            has been the industry's standard dummy text ever since the 1500s</p>
                                        <div class="bookmark favourite-btn">
                                            <i class="iw-14 ih-14" data-feather="bookmark"></i>
                                        </div>
                                        <div class="people-likes">
                                            <ul>
                                                <li class="popover-cls" data-bs-toggle="popover" data-placement="right"
                                                    data-name="sufiya eliza" data-img="../user_assets/images/user-sm/1.jpg">
                                                    <img src="../user_assets/images/user-sm/1.jpg"
                                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                                </li>
                                                <li class="popover-cls" data-bs-toggle="popover" data-placement="right"
                                                    data-name="sufiya eliza" data-img="../user_assets/images/user-sm/2.jpg">
                                                    <img src="../user_assets/images/user-sm/2.jpg"
                                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                                </li>
                                                <li class="popover-cls" data-bs-toggle="popover" data-placement="right"
                                                    data-name="sufiya eliza" data-img="../user_assets/images/user-sm/3.jpg">
                                                    <img src="../user_assets/images/user-sm/3.jpg"
                                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                                </li>
                                            </ul>
                                            <h6>+12 people react this post</h6>
                                        </div>
                                    </div>
                                    <div class="like-panel">
                                        <div class="left-emoji">
                                            <ul>
                                                <li>
                                                    <img src="../user_assets/svg/emoji/040.svg" alt="smile">
                                                </li>
                                                <li>
                                                    <img src="../user_assets/svg/emoji/113.svg" alt="heart">
                                                </li>
                                                <li>
                                                    <img src="../user_assets/svg/emoji/027.svg" alt="cry">
                                                </li>
                                                <li>
                                                    <img src="../user_assets/svg/emoji/033.svg" alt="angry">
                                                </li>
                                            </ul>
                                            <h6>+75</h6>
                                        </div>
                                        <div class="right-stats">
                                            <ul>
                                                <li>
                                                    <h5>
                                                        <i class="iw-16 ih-16" data-feather="message-square"></i>
                                                        <span>4565</span> comment
                                                    </h5>
                                                </li>
                                                <li>
                                                    <h5>
                                                        <i class="iw-16 ih-16" data-feather="share"></i><span>985</span>
                                                        share
                                                    </h5>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="post-react">
                                        <ul>
                                            <li class="react-btn">
                                                <a class="react-click" href="javascript:void(0)">
                                                    <i class="iw-18 ih-18" data-feather="smile"></i> react
                                                </a>
                                                <div class="react-box">
                                                    <ul>
                                                        <li data-title="smile">
                                                            <a href="javascript:void(0)">
                                                                <img src="../user_assets/svg/emoji/040.svg" alt="smile">
                                                            </a>
                                                        </li>
                                                        <li data-title="love">
                                                            <a href="javascript:void(0)">
                                                                <img src="../user_assets/svg/emoji/113.svg" alt="heart">
                                                            </a>
                                                        </li>
                                                        <li data-title="cry">
                                                            <a href="javascript:void(0)">
                                                                <img src="../user_assets/svg/emoji/027.svg" alt="cry">
                                                            </a>
                                                        </li>
                                                        <li data-title="wow">
                                                            <a href="javascript:void(0)">
                                                                <img src="../user_assets/svg/emoji/052.svg" alt="angry">
                                                            </a>
                                                        </li>
                                                        <li data-title="angry">
                                                            <a href="javascript:void(0)">
                                                                <img src="../user_assets/svg/emoji/039.svg" alt="angry">
                                                            </a>
                                                        </li>
                                                        <li data-title="haha">
                                                            <a href="javascript:void(0)">
                                                                <img src="../user_assets/svg/emoji/042.svg" alt="">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="comment-click">
                                                <a href="javascript:void(0)">
                                                    <i class="iw-18 ih-18" data-feather="message-square"></i> comment
                                                </a>
                                            </li>
                                            <li data-bs-target="#shareModal" data-bs-toggle="modal">
                                                <a href="javascript:void(0)">
                                                    <i class="iw-16 ih-16" data-feather="share"></i> share
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="comment-section">
                                        <div class="comments d-block">
                                            <div class="ldr-comments">
                                                <ul>
                                                    <li>
                                                        <div class="media">
                                                            <div class="ldr-img"></div>
                                                            <div class="media-body">
                                                                <div class="contents">
                                                                    <div class="ldr-content"></div>
                                                                    <div class="ldr-content"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="sub-comment">
                                                            <li>
                                                                <div class="media">
                                                                    <div class="ldr-img"></div>
                                                                    <div class="media-body">
                                                                        <div class="contents">
                                                                            <div class="ldr-content"></div>
                                                                            <div class="ldr-content"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="media">
                                                            <div class="ldr-img"></div>
                                                            <div class="media-body">
                                                                <div class="contents">
                                                                    <div class="ldr-content"></div>
                                                                    <div class="ldr-content"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="media">
                                                            <div class="ldr-img"></div>
                                                            <div class="media-body">
                                                                <div class="contents">
                                                                    <div class="ldr-content"></div>
                                                                    <div class="ldr-content"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="main-comment">
                                                <div class="media">
                                                    <a href="#" class="user-img popover-cls" data-bs-toggle="popover"
                                                        data-placement="right" data-name="Pabelo mukrani"
                                                        data-img="../user_assets/images/user-sm/2.jpg">
                                                        <img src="../user_assets/images/user-sm/2.jpg"
                                                            class="img-fluid blur-up lazyload bg-img" alt="user">
                                                    </a>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h5>Pabelo Mukrani</h5>
                                                        </a>
                                                        <p>Oooo Very Cute and Sweet Dog, happy birthday Cuty....
                                                            &#128578;
                                                        </p>
                                                        <ul class="comment-option">
                                                            <li><a href="#">like (5)</a></li>
                                                            <li><a href="#">reply</a></li>
                                                            <li><a href="#">translate</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="comment-time">
                                                        <h6>50 mins ago</h6>
                                                    </div>
                                                </div>
                                                <div class="sub-comment">
                                                    <div class="media">
                                                        <a href="#" class="user-img popover-cls"
                                                            data-bs-toggle="popover" data-placement="right"
                                                            data-name="sufiya elija"
                                                            data-img="../user_assets/images/user-sm/3.jpg">
                                                            <img src="../user_assets/images/user-sm/3.jpg"
                                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                                        </a>
                                                        <div class="media-body">
                                                            <a href="#">
                                                                <h5>sufiya elija</h5>
                                                            </a>
                                                            <p>Thank You So Much ❤❤</p>
                                                            <ul class="comment-option">
                                                                <li><a href="#">like</a></li>
                                                                <li><a href="#">reply</a></li>
                                                                <li><a href="#">translate</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="comment-time">
                                                            <h6>50 mins ago</h6>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <a href="#" class="user-img popover-cls"
                                                            data-bs-toggle="popover" data-placement="right"
                                                            data-name="sufiya eliza"
                                                            data-img="../user_assets/images/user-sm/4.jpg">
                                                            <img src="../user_assets/images/user-sm/4.jpg"
                                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                                        </a>
                                                        <div class="media-body">
                                                            <a href="#">
                                                                <h5>sufiya elija</h5>
                                                            </a>
                                                            <p>Thank You So Much ❤❤</p>
                                                            <ul class="comment-option">
                                                                <li><a href="#">like</a></li>
                                                                <li><a href="#">reply</a></li>
                                                                <li><a href="#">translate</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="comment-time">
                                                            <h6>50 mins ago</h6>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0)" class="loader">
                                                        <i class="iw-15 ih-15" data-feather="rotate-cw"></i> load more
                                                        replies
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="main-comment">
                                                <div class="media">
                                                    <a href="#" class="user-img popover-cls" data-bs-toggle="popover"
                                                        data-placement="right" data-name="pabelo mukrani"
                                                        data-img="../user_assets/images/user-sm/2.jpg">
                                                        <img src="../user_assets/images/user-sm/2.jpg"
                                                            class="img-fluid blur-up lazyload bg-img" alt="user">
                                                    </a>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h5>Pabelo Mukrani</h5>
                                                        </a>
                                                        <p>It’s party time, Sufiya..... and happy birthday cuty 🎉🎊</p>
                                                        <ul class="comment-option">
                                                            <li><a href="#">like</a></li>
                                                            <li><a href="#">reply</a></li>
                                                            <li><a href="#">translate</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="comment-time">
                                                        <h6>50 mins ago</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply">
                                            <div class="search-input input-style input-lg icon-right">
                                                <input type="text" class="form-control emojiPicker"
                                                    placeholder="write a comment..">
                                                <a href="javascript:void(0)">
                                                    <i data-feather="smile" class="icon icon-2 iw-14 ih-14"></i>
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <i class="iw-14 ih-14 icon" data-feather="camera"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post-wrapper col-grid-box section-t-space no-background">
                                <div class="post-details">
                                    <div class="img-wrapper">
                                        <div class="slider-section">
                                            <div class="friend-slide ratio_landscape default-space no-arrow">
                                                <div>
                                                    <div class="profile-box friend-box">
                                                        <div class="profile-content">
                                                            <div class="image-section">
                                                                <div class="profile-img">
                                                                    <div>
                                                                        <img src="{{asset('user_assets/images/user-sm/1.jpg')}}"
                                                                            class="img-fluid blur-up lazyload bg-img"
                                                                            alt="profile">
                                                                    </div>
                                                                    <span class="stats">
                                                                        <img src="{{asset('user_assets/images/icon/verified.png')}}"
                                                                            class="img-fluid blur-up lazyload"
                                                                            alt="verified">
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="profile-detail">
                                                                <h2>kelin jasen <span>❤</span></h2>
                                                                <div class="counter-stats">
                                                                    <ul>
                                                                        <li>
                                                                            <h3 class="counter-value">546</h3>
                                                                            <h5>following</h5>
                                                                        </li>
                                                                        <li>
                                                                            <h3 class="counter-value">6845</h3>
                                                                            <h5>followers</h5>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <a href="profile(friend).html"
                                                                    class="btn btn-outline">add friend</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="profile-box friend-box">
                                                        <div class="profile-content">
                                                            <div class="image-section">
                                                                <div class="profile-img">
                                                                    <div>
                                                                        <img src="{{asset('user_assets/images/user-sm/2.jpg')}}"
                                                                            class="img-fluid blur-up lazyload bg-img"
                                                                            alt="profile">
                                                                    </div>
                                                                    <span class="stats">
                                                                        <img src="{{asset('user_assets/images/icon/verified.png')}}"
                                                                            class="img-fluid blur-up lazyload"
                                                                            alt="verified">
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="profile-detail">
                                                                <h2>kelin jasen <span>❤</span></h2>
                                                                <div class="counter-stats">
                                                                    <ul>
                                                                        <li>
                                                                            <h3 class="counter-value">546</h3>
                                                                            <h5>following</h5>
                                                                        </li>
                                                                        <li>
                                                                            <h3 class="counter-value">6845</h3>
                                                                            <h5>followers</h5>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <a href="profile(friend).html"
                                                                    class="btn btn-outline">add friend</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="profile-box friend-box">
                                                        <div class="profile-content">
                                                            <div class="image-section">
                                                                <div class="profile-img">
                                                                    <div>
                                                                        <img src="{{asset('user_assets/images/user-sm/3.jpg')}}"
                                                                            class="img-fluid blur-up lazyload bg-img"
                                                                            alt="profile">
                                                                    </div>
                                                                    <span class="stats">
                                                                        <img src="{{asset('user_assets/images/icon/verified.png')}}"
                                                                            class="img-fluid blur-up lazyload"
                                                                            alt="verified">
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="profile-detail">
                                                                <h2>kelin jasen <span>❤</span></h2>
                                                                <div class="counter-stats">
                                                                    <ul>
                                                                        <li>
                                                                            <h3 class="counter-value">546</h3>
                                                                            <h5>following</h5>
                                                                        </li>
                                                                        <li>
                                                                            <h3 class="counter-value">6845</h3>
                                                                            <h5>followers</h5>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <a href="profile(friend).html"
                                                                    class="btn btn-outline">add friend</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="profile-box friend-box">
                                                        <div class="profile-content">
                                                            <div class="image-section">
                                                                <div class="profile-img">
                                                                    <div>
                                                                        <img src="{{asset('user_assets/images/user-sm/4.jpg')}}"
                                                                            class="img-fluid blur-up lazyload bg-img"
                                                                            alt="profile">
                                                                    </div>
                                                                    <span class="stats">
                                                                        <img src="{{asset('user_assets/images/icon/verified.png')}}"
                                                                            class="img-fluid blur-up lazyload"
                                                                            alt="verified">
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="profile-detail">
                                                                <h2>kelin jasen <span>❤</span></h2>
                                                                <div class="counter-stats">
                                                                    <ul>
                                                                        <li>
                                                                            <h3 class="counter-value">546</h3>
                                                                            <h5>following</h5>
                                                                        </li>
                                                                        <li>
                                                                            <h3 class="counter-value">6845</h3>
                                                                            <h5>followers</h5>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <a href="profile(friend).html"
                                                                    class="btn btn-outline">add friend</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post-wrapper col-grid-box section-t-space">
                                <div class="post-title">
                                    <div class="profile">
                                        <div class="media">
                                            <a class="popover-cls user-img" data-bs-toggle="popover"
                                                data-placement="right" data-name="sufiya eliza"
                                                data-img="{{asset('user_assets/images/user-sm/1.jpg')}}">
                                                <img src="{{asset('user_assets/images/user-sm/1.jpg')}}"
                                                    class="img-fluid blur-up lazyload bg-img" alt="user">
                                            </a>
                                            <div class="media-body">
                                                <h5>sufiya eliza</h5>
                                                <h6>30 mins ago</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="setting-btn ms-auto setting-dropdown no-bg">
                                        <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                            <div role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="icon icon-font-color iw-14"
                                                    data-feather="more-horizontal"></i>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                                <ul>
                                                    <li>
                                                        <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                data-feather="bookmark"></i>save post</a>
                                                    </li>
                                                    <li>
                                                        <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                data-feather="x-square"></i>hide post</a>
                                                    </li>
                                                    <li>
                                                        <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                data-feather="x-octagon"></i>unfollow sufiya</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-details">
                                    <div class="detail-box">
                                        <h3>Celebration new album song launched</h3>
                                        <h5 class="tag"><span>#Musiccelebration,</span> #music, #party, #music</h5>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            has been the industry's standard dummy text ever since the 1500s</p>
                                        <div class="bookmark favourite-btn">
                                            <i class="iw-14 ih-14" data-feather="bookmark"></i>
                                        </div>
                                        <div class="people-likes">
                                            <ul>
                                                <li class="popover-cls" data-bs-toggle="popover" data-placement="right"
                                                    data-name="sufiya eliza" data-img="{{asset('user_assets/images/user-sm/1.jpg')}}">
                                                    <img src="{{asset('user_assets/images/user-sm/1.jpg')}}"
                                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                                </li>
                                                <li class="popover-cls" data-bs-toggle="popover" data-placement="right"
                                                    data-name="sufiya eliza" data-img="{{asset('user_assets/images/user-sm/2.jpg')}}">
                                                    <img src="{{asset('user_assets/images/user-sm/2.jpg')}}"
                                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                                </li>
                                                <li class="popover-cls" data-bs-toggle="popover" data-placement="right"
                                                    data-name="sufiya eliza" data-img="{{asset('user_assets/images/user-sm/3.jpg')}}">
                                                    <img src="{{asset('user_assets/images/user-sm/3.jpg')}}"
                                                        class="img-fluid blur-up lazyload bg-img" alt="">
                                                </li>
                                            </ul>
                                            <h6>+12 people react this post</h6>
                                        </div>
                                    </div>
                                    <div class="like-panel">
                                        <div class="left-emoji">
                                            <ul>
                                                <li>
                                                    <img src="{{asset('user_assets/svg/emoji/040.svg')}}" alt="smile">
                                                </li>
                                                <li>
                                                    <img src="{{asset('user_assets/svg/emoji/113.svg')}}" alt="heart">
                                                </li>
                                                <li>
                                                    <img src="{{asset('user_assets/svg/emoji/027.svg')}}" alt="cry">
                                                </li>
                                                <li>
                                                    <img src="{{asset('user_assets/svg/emoji/033.svg')}}" alt="angry">
                                                </li>
                                            </ul>
                                            <h6>+75</h6>
                                        </div>
                                        <div class="right-stats">
                                            <ul>
                                                <li>
                                                    <h5>
                                                        <i class="iw-16 ih-16" data-feather="message-square"></i>
                                                        <span>4565</span> comment
                                                    </h5>
                                                </li>
                                                <li>
                                                    <h5>
                                                        <i class="iw-16 ih-16" data-feather="share"></i><span>985</span>
                                                        share
                                                    </h5>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="post-react">
                                        <ul>
                                            <li class="react-btn">
                                                <a class="react-click" href="javascript:void(0)">
                                                    <i class="iw-18 ih-18" data-feather="smile"></i> react
                                                </a>
                                                <div class="react-box">
                                                    <ul>
                                                        <li data-title="smile">
                                                            <a href="javascript:void(0)">
                                                                <img src="{{asset('user_user_assets/svg/emoji/040.svg')}}" alt="smile">
                                                            </a>
                                                        </li>
                                                        <li data-title="love">
                                                            <a href="javascript:void(0)">
                                                                <img src="{{asset('user_user_assets/svg/emoji/113.svg')}}" alt="heart">
                                                            </a>
                                                        </li>
                                                        <li data-title="cry">
                                                            <a href="javascript:void(0)">
                                                                <img src="{{asset('user_user_assets/svg/emoji/027.svg')}}" alt="cry">
                                                            </a>
                                                        </li>
                                                        <li data-title="wow">
                                                            <a href="javascript:void(0)">
                                                                <img src="{{asset('user_user_assets/svg/emoji/052.svg')}}" alt="angry">
                                                            </a>
                                                        </li>
                                                        <li data-title="angry">
                                                            <a href="javascript:void(0)">
                                                                <img src="{{asset('user_user_assets/svg/emoji/039.svg')}}" alt="angry">
                                                            </a>
                                                        </li>
                                                        <li data-title="haha">
                                                            <a href="javascript:void(0)">
                                                                <img src="{{asset('user_user_assets/svg/emoji/042.svg')}}" alt="">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="comment-click">
                                                <a href="javascript:void(0)">
                                                    <i class="iw-18 ih-18" data-feather="message-square"></i> comment
                                                </a>
                                            </li>
                                            <li data-bs-target="#shareModal" data-bs-toggle="modal">
                                                <a href="javascript:void(0)">
                                                    <i class="iw-16 ih-16" data-feather="share"></i> share
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="comment-section">
                                        <div class="comments d-none">
                                            <div class="ldr-comments">
                                                <ul>
                                                    <li>
                                                        <div class="media">
                                                            <div class="ldr-img"></div>
                                                            <div class="media-body">
                                                                <div class="contents">
                                                                    <div class="ldr-content"></div>
                                                                    <div class="ldr-content"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="sub-comment">
                                                            <li>
                                                                <div class="media">
                                                                    <div class="ldr-img"></div>
                                                                    <div class="media-body">
                                                                        <div class="contents">
                                                                            <div class="ldr-content"></div>
                                                                            <div class="ldr-content"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <div class="media">
                                                            <div class="ldr-img"></div>
                                                            <div class="media-body">
                                                                <div class="contents">
                                                                    <div class="ldr-content"></div>
                                                                    <div class="ldr-content"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="media">
                                                            <div class="ldr-img"></div>
                                                            <div class="media-body">
                                                                <div class="contents">
                                                                    <div class="ldr-content"></div>
                                                                    <div class="ldr-content"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="main-comment">
                                                <div class="media">
                                                    <a href="#" class="user-img popover-cls" data-bs-toggle="popover"
                                                        data-placement="right" data-name="Pabelo mukrani"
                                                        data-img="{{asset('user_assets/images/user-sm/2.jpg')}}">
                                                        <img src="{{asset('user_assets/images/user-sm/2.jpg')}}"
                                                            class="img-fluid blur-up lazyload bg-img" alt="user">
                                                    </a>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h5>Pabelo Mukrani</h5>
                                                        </a>
                                                        <p>Oooo Very Cute and Sweet Dog, happy birthday Cuty....
                                                            &#128578;
                                                        </p>
                                                        <ul class="comment-option">
                                                            <li><a href="#">like (5)</a></li>
                                                            <li><a href="#">reply</a></li>
                                                            <li><a href="#">translate</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="comment-time">
                                                        <h6>50 mins ago</h6>
                                                    </div>
                                                </div>
                                                <div class="sub-comment">
                                                    <div class="media">
                                                        <a href="#" class="user-img popover-cls"
                                                            data-bs-toggle="popover" data-placement="right"
                                                            data-name="sufiya elija"
                                                            data-img="{{asset('user_assets/images/user-sm/3.jpg')}}">
                                                            <img src="{{asset('user_assets/images/user-sm/3.jpg')}}"
                                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                                        </a>
                                                        <div class="media-body">
                                                            <a href="#">
                                                                <h5>sufiya elija</h5>
                                                            </a>
                                                            <p>Thank You So Much ❤❤</p>
                                                            <ul class="comment-option">
                                                                <li><a href="#">like</a></li>
                                                                <li><a href="#">reply</a></li>
                                                                <li><a href="#">translate</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="comment-time">
                                                            <h6>50 mins ago</h6>
                                                        </div>
                                                    </div>
                                                    <div class="media">
                                                        <a href="#" class="user-img popover-cls"
                                                            data-bs-toggle="popover" data-placement="right"
                                                            data-name="sufiya eliza"
                                                            data-img="{{asset('user_assets/images/user-sm/4.jpg')}}">
                                                            <img src="{{asset('user_assets/images/user-sm/4.jpg')}}"
                                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                                        </a>
                                                        <div class="media-body">
                                                            <a href="#">
                                                                <h5>sufiya elija</h5>
                                                            </a>
                                                            <p>Thank You So Much ❤❤</p>
                                                            <ul class="comment-option">
                                                                <li><a href="#">like</a></li>
                                                                <li><a href="#">reply</a></li>
                                                                <li><a href="#">translate</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="comment-time">
                                                            <h6>50 mins ago</h6>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0)" class="loader">
                                                        <i class="iw-15 ih-15" data-feather="rotate-cw"></i> load more
                                                        replies
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="main-comment">
                                                <div class="media">
                                                    <a href="#" class="user-img popover-cls" data-bs-toggle="popover"
                                                        data-placement="right" data-name="pabelo mukrani"
                                                        data-img="{{asset('user_assets/images/user-sm/2.jpg')}}">
                                                        <img src="{{asset('user_assets/images/user-sm/2.jpg')}}"
                                                            class="img-fluid blur-up lazyload bg-img" alt="user">
                                                    </a>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h5>Pabelo Mukrani</h5>
                                                        </a>
                                                        <p>It’s party time, Sufiya..... and happy birthday cuty 🎉🎊</p>
                                                        <ul class="comment-option">
                                                            <li><a href="#">like</a></li>
                                                            <li><a href="#">reply</a></li>
                                                            <li><a href="#">translate</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="comment-time">
                                                        <h6>50 mins ago</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply">
                                            <div class="search-input input-style input-lg icon-right">
                                                <input type="text" class="form-control emojiPicker"
                                                    placeholder="write a comment..">
                                                <a href="javascript:void(0)">
                                                    <i data-feather="smile" class="icon icon-2 iw-14 ih-14"></i>
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <i class="iw-14 ih-14 icon" data-feather="camera"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="load-more" class="post-loader">
                            <div class="loader-icon">
                                <i class="icon-theme iw-25 ih-25" data-feather="rotate-ccw"></i>
                            </div>
                            <div class="no-more-text">
                                <p>no more post</p>
                            </div>
                        </div>
                    </div>
                    <div class="content-right">

                        <!-- gallery section -->
                        <div class="gallery-section">
                            <div class="gallery-top">
                                <div class="card-title">
                                    <h3>gallery</h3>
                                    <h5>156 photos</h5>
                                    <div class="settings">
                                        <div class="setting-btn">
                                            <a href="#">
                                                <i class="icon icon-dark stroke-width-3 iw-11 ih-11"
                                                    data-feather="rotate-cw"></i>
                                            </a>
                                        </div>
                                        <div class="setting-btn ms-2 setting-dropdown">
                                            <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                                <a href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="icon-dark stroke-width-3 icon iw-11 ih-11"
                                                        data-feather="sun"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                                    <ul>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="edit"></i>edit
                                                                profile</a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="user"></i>view
                                                                profile</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-section ratio_square">
                                <div class="container-fluid p-0">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="overlay">
                                                <div class="portfolio-image">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#imageModel">
                                                        <img src="{{asset('user_assets/images/story/1.jpg')}}" alt=""
                                                            class="img-fluid blur-up lazyload bg-img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="overlay">
                                                <div class="portfolio-image">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#imageModel">
                                                        <img src="{{asset('user_assets/images/story/2.jpg')}}" alt=""
                                                            class="img-fluid blur-up lazyload bg-img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="overlay">
                                                <div class="portfolio-image">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#imageModel">
                                                        <img src="{{asset('user_assets/images/story/3.jpg')}}" alt=""
                                                            class="img-fluid blur-up lazyload bg-img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 row m-0">
                                            <div class="col-12 pt-cls p-0">
                                                <div class="overlay">
                                                    <div class="portfolio-image">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#imageModel">
                                                            <img src="{{asset('user_assets/images/story/4.jpg')}}" alt=""
                                                                class="img-fluid blur-up lazyload bg-img">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 pt-cls p-0">
                                                <div class="overlay">
                                                    <div class="portfolio-image">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#imageModel">
                                                            <img src="{{asset('user_assets/images/story/6.jpg')}}" alt=""
                                                                class="img-fluid blur-up lazyload bg-img">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8 pt-cls">
                                            <div class="overlay">
                                                <div class="portfolio-image">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#imageModel">
                                                        <img src="{{asset('user_assets/images/story/5.jpg')}}" alt=""
                                                            class="img-fluid blur-up lazyload bg-img">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sticky-top">
                            <!-- event -->
                            <div class="event-box section-t-space ratio2_3">
                                <div class="image-section">
                                    <img src="{{asset('user_assets/images/event/1.jpg')}}" class="img-fluid blur-up lazyload bg-img"
                                        alt="event">
                                    <div class="card-title">
                                        <h3>event</h3>
                                        <div class="settings">
                                            <div class="setting-btn">
                                                <a href="#" class="d-flex">
                                                    <i class="icon icon-dark stroke-width-3 iw-11 ih-11"
                                                        data-feather="rotate-cw"></i>
                                                </a>
                                            </div>
                                            <div class="setting-btn ms-2 setting-dropdown">
                                                <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                                    <a href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="icon-dark stroke-width-3 icon iw-11 ih-11"
                                                            data-feather="sun"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                                        <ul>
                                                            <li>
                                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                        data-feather="edit"></i>remind
                                                                    me</a>
                                                            </li>
                                                            <li>
                                                                <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                        data-feather="settings"></i>setting</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="play-btn" data-bs-toggle="modal" data-bs-target="#videoPlayer">
                                        <img src="{{asset('user_assets/images/icon/play.png')}}" class="img-fluid blur-up lazyload"
                                            alt="play">
                                    </div>
                                </div>
                                <div class="event-content">
                                    <h3>christmas 2021</h3>
                                    <h6>26 january 2021</h6>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry
                                        <span>15256 People Going</span>
                                    </p>
                                    <div class="bottom-part">
                                        <a href="#" class="event-btn">going / not going</a>
                                    </div>
                                    <a href="#" class="share-btn">
                                        <i class="icon-dark stroke-width-3 iw-14 ih-14"
                                            data-feather="corner-up-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- page body end -->


    <!-- story model start -->
    <div class="modal story-model" id="storyModel" tabindex="-1" role="dialog" aria-labelledby="storyModel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="story-bg">
                        <div class="container-fluid p-0">
                            <div class="row m-0">
                                <div class="left-box col-xl-3 col-lg-4">
                                    <div class="model-title">
                                        <div class="title-main">
                                            <h2>stories</h2>
                                        </div>
                                        <div class="title-setting">
                                            <ul>
                                                <li><a href="#">archive</a></li>
                                                <li><a href="#">settings</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="modal-flex">
                                        <div class="add-story">
                                            <h4 class="story-title">your story</h4>
                                            <div class="media list-media">
                                                <div class="story-img" data-bs-toggle="modal"
                                                    data-bs-target="#addStory">
                                                    <div class="user-img">
                                                        <img src="{{asset('user_assets/images/story-bg.jpg')}}"
                                                            class="img-fluid blur-up lazyload bg-img" alt="user">
                                                    </div>
                                                    <div class="add-icon">
                                                        <div class="icon">
                                                            <img src="{{asset('user_assets/images/icon/plus.png')}}"
                                                                class="img-fluid blur-up lazyload" alt="plus">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <h5>add story</h5>
                                                    <h6>share your photos or video</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="friend-story">
                                            <h4 class="story-title">all stories</h4>
                                            <div class="slider-nav">
                                                <div>
                                                    <div class="media list-media">
                                                        <div class="story-img seen">
                                                            <div class="user-img">
                                                                <img src="{{asset('user_assets/images/user-sm/1.jpg')}}"
                                                                    class="img-fluid blur-up lazyload bg-img"
                                                                    alt="user">
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>Petey Cruiser</h5>
                                                            <h6>2 hours ago</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="media list-media">
                                                        <div class="story-img seen">
                                                            <div class="user-img">
                                                                <img src="{{asset('user_assets/images/user-sm/2.jpg')}}"
                                                                    class="img-fluid blur-up lazyload bg-img"
                                                                    alt="user">
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>Anna Sthesia</h5>
                                                            <h6>3 hours ago</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="media list-media">
                                                        <div class="story-img">
                                                            <div class="user-img">
                                                                <img src="{{asset('user_assets/images/user-sm/3.jpg')}}"
                                                                    class="img-fluid blur-up lazyload bg-img"
                                                                    alt="user">
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>Paul Molive</h5>
                                                            <h6>5 hours ago</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="media list-media">
                                                        <div class="story-img">
                                                            <div class="user-img">
                                                                <img src="{{asset('user_assets/images/user-sm/4.jpg')}}"
                                                                    class="img-fluid blur-up lazyload bg-img"
                                                                    alt="user">
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>Anna Mull</h5>
                                                            <h6>5 hours ago</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="media list-media">
                                                        <div class="story-img">
                                                            <div class="user-img">
                                                                <img src="{{asset('user_assets/images/user-sm/5.jpg')}}"
                                                                    class="img-fluid blur-up lazyload bg-img"
                                                                    alt="user">
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>Paige Turner</h5>
                                                            <h6>5 hours ago</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="media list-media">
                                                        <div class="story-img">
                                                            <div class="user-img">
                                                                <img src="{{asset('user_assets/images/user-sm/6.jpg')}}"
                                                                    class="img-fluid blur-up lazyload bg-img"
                                                                    alt="user">
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5>Bob Frapples</h5>
                                                            <h6>5 hours ago</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="right-box col-xl-9 col-lg-8 p-0">
                                    <a href="#" data-bs-dismiss="modal"><i data-feather="x"
                                            class="icon-light close"></i></a>
                                    <div class="sliderContainer">
                                        <div class="slider single-item">
                                            <div>
                                                <div class="story-image"><img src="{{asset('user_assets/images/post/1.jpg')}}"
                                                        class="img-fluid blur-up lazyload" alt=""></div>
                                            </div>
                                            <div>
                                                <div class="story-image"><img src="{{asset('user_assets/images/post/2.jpg')}}"
                                                        class="img-fluid blur-up lazyload" alt=""></div>
                                            </div>
                                            <div>
                                                <div class="story-image"><img src="{{asset('user_assets/images/post/3.jpg')}}"
                                                        class="img-fluid blur-up lazyload" alt=""></div>
                                            </div>
                                            <div>
                                                <div class="story-image"><img src="{{asset('user_assets/images/post/4.jpg')}}"
                                                        class="img-fluid blur-up lazyload" alt=""></div>
                                            </div>
                                            <div>
                                                <div class="story-image"><img src="{{asset('user_assets/images/post/5.jpg')}}"
                                                        class="img-fluid blur-up lazyload" alt=""></div>
                                            </div>
                                            <div>
                                                <div class="story-image"><img src="{{asset('user_assets/images/post/6.jpg')}}"
                                                        class="img-fluid blur-up lazyload" alt=""></div>
                                            </div>
                                        </div>
                                        <div class="progressBarContainer">
                                            <div class="item">
                                                <span data-slick-index="0" class="progressBar"></span>
                                            </div>
                                            <div class="item">
                                                <span data-slick-index="1" class="progressBar"></span>
                                            </div>
                                            <div class="item">
                                                <span data-slick-index="2" class="progressBar"></span>
                                            </div>
                                            <div class="item">
                                                <span data-slick-index="3" class="progressBar"></span>
                                            </div>
                                            <div class="item">
                                                <span data-slick-index="4" class="progressBar"></span>
                                            </div>
                                            <div class="item">
                                                <span data-slick-index="5" class="progressBar"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reply-section">
                                        <div class="reply-form">
                                            <input class="form-control" placeholder="reply...">
                                        </div>
                                        <ul class="emoji icon-xl">
                                            <li><img src="{{asset('user_user_assets/svg/emoji/040.svg')}}"
                                                    class="img-fluid blur-up lazyload" alt="smile">
                                            </li>
                                            <li><img src="{{asset('user_user_assets/svg/emoji/113.svg')}}"
                                                    class="img-fluid blur-up lazyload" alt="smile">
                                            </li>
                                            <li><img src="{{asset('user_user_assets/svg/emoji/027.svg')}}"
                                                    class="img-fluid blur-up lazyload" alt="smile">
                                            </li>
                                            <li><img src="{{asset('user_user_assets/svg/emoji/052.svg')}}"
                                                    class="img-fluid blur-up lazyload" alt="smile">
                                            </li>
                                            <li><img src="{{asset('user_user_assets/svg/emoji/039.svg')}}"
                                                    class="img-fluid blur-up lazyload" alt="smile">
                                            </li>
                                            <li><img src="{{asset('user_user_assets/svg/emoji/042.svg')}}"
                                                    class="img-fluid blur-up lazyload" alt="smile">
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- story model end -->
    <!-- video player model start -->
    <div class="modal fade bd-example-modal-lg" id="videoPlayer" aria-labelledby="videoPlayer" tabindex="-1"
        role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body video-model">
                    <iframe class="video" src="https://www.youtube.com/embed/TKnufs85hXk"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- video player model end -->
    <!-- gallery image model -->
    <div class="modal comment-model" id="imageModel" aria-labelledby="imageModel" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div>
                    <div class="image-gallery">
                        <div class="row m-0">
                            <div class="col-xl-9 col-lg-8 p-0">
                                <a href="#" data-bs-dismiss="modal"><i data-feather="x"
                                        class="icon-light close-btn"></i></a>
                                <div class="slide-1 box-arrow dots-number">
                                    <div>
                                        <div class="img-part">
                                            <img src="{{asset('user_assets/images/post/15.jpg')}}" class="img-fluid blur-up lazyload"
                                                alt="">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="img-part">
                                            <img src="{{asset('user_assets/images/post/16.jpg')}}" class="img-fluid blur-up lazyload"
                                                alt="">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="img-part">
                                            <img src="{{asset('user_assets/images/post/17.jpg')}}" class="img-fluid blur-up lazyload"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 p-0">
                                <div class="comment-part">
                                    <div class="user-detail">
                                        <div class="user-media">
                                            <div class="media">
                                                <a class="user-img">
                                                    <img src="{{asset('user_assets/images/user-sm/1.jpg')}}"
                                                        class="img-fluid blur-up lazyload bg-img" alt="user">
                                                    <span class="available-stats"></span>
                                                </a>
                                                <div class="media-body">
                                                    <h5 class="user-name">Paige Turner</h5>
                                                    <h6>alabma, USA</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setting-btn ms-auto setting-dropdown no-bg">
                                            <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                                <div role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="icon icon-font-color iw-14"
                                                        data-feather="more-horizontal"></i>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                                    <ul>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="bookmark"></i>save
                                                                post</a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="edit"></i>edit post</a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="x-square"></i>hide
                                                                post</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-panel mb-0">
                                        <div class="post-wrapper">
                                            <div class="post-details">
                                                <div class="like-panel">
                                                    <div class="left-emoji">
                                                        <ul>
                                                            <li>
                                                                <img src="{{asset('user_user_assets/svg/emoji/040.svg')}}" alt="smile">
                                                            </li>
                                                            <li>
                                                                <img src="{{asset('user_user_assets/svg/emoji/113.svg')}}" alt="heart">
                                                            </li>
                                                        </ul>
                                                        <h6>+75</h6>
                                                    </div>
                                                    <div class="right-stats">
                                                        <ul>
                                                            <li>
                                                                <h5>
                                                                    <i class="iw-16 ih-16"
                                                                        data-feather="message-square"></i>
                                                                    <span>4565</span> comment
                                                                </h5>
                                                            </li>
                                                            <li>
                                                                <h5>
                                                                    <i class="iw-16 ih-16"
                                                                        data-feather="share"></i><span>985</span> share
                                                                </h5>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="post-react">
                                                    <ul>
                                                        <li class="react-btn">
                                                            <a class="react-click" href="javascript:void(0)">
                                                                <i class="iw-18 ih-18" data-feather="smile"></i> react
                                                            </a>
                                                            <div class="react-box">
                                                                <ul>
                                                                    <li data-title="smile">
                                                                        <a href="javascript:void(0)">
                                                                            <img src="{{asset('user_user_assets/svg/emoji/040.svg')}}"
                                                                                alt="smile">
                                                                        </a>
                                                                    </li>
                                                                    <li data-title="love">
                                                                        <a href="javascript:void(0)">
                                                                            <img src="{{asset('user_user_assets/svg/emoji/113.svg')}}"
                                                                                alt="heart">
                                                                        </a>
                                                                    </li>
                                                                    <li data-title="cry">
                                                                        <a href="javascript:void(0)">
                                                                            <img src="{{asset('user_user_assets/svg/emoji/027.svg')}}"
                                                                                alt="cry">
                                                                        </a>
                                                                    </li>
                                                                    <li data-title="wow">
                                                                        <a href="javascript:void(0)">
                                                                            <img src="{{asset('user_user_assets/svg/emoji/052.svg')}}"
                                                                                alt="angry">
                                                                        </a>
                                                                    </li>
                                                                    <li data-title="angry">
                                                                        <a href="javascript:void(0)">
                                                                            <img src="{{asset('user_user_assets/svg/emoji/039.svg')}}"
                                                                                alt="angry">
                                                                        </a>
                                                                    </li>
                                                                    <li data-title="haha">
                                                                        <a href="javascript:void(0)">
                                                                            <img src="{{asset('user_user_assets/svg/emoji/042.svg')}}"
                                                                                alt="">
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <li class="comment-click">
                                                            <a href="javascript:void(0)">
                                                                <i class="iw-18 ih-18"
                                                                    data-feather="message-square"></i> comment
                                                            </a>
                                                        </li>
                                                        <li data-bs-target="#shareModal" data-bs-toggle="modal">
                                                            <a href="javascript:void(0)">
                                                                <i class="iw-16 ih-16" data-feather="share"></i> share
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="comment-section">
                                                    <div class="comments d-block">
                                                        <div class="ldr-comments">
                                                            <ul>
                                                                <li>
                                                                    <div class="media">
                                                                        <div class="ldr-img"></div>
                                                                        <div class="media-body">
                                                                            <div class="contents">
                                                                                <div class="ldr-content"></div>
                                                                                <div class="ldr-content"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <ul class="sub-comment">
                                                                        <li>
                                                                            <div class="media">
                                                                                <div class="ldr-img"></div>
                                                                                <div class="media-body">
                                                                                    <div class="contents">
                                                                                        <div class="ldr-content"></div>
                                                                                        <div class="ldr-content"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                                                <li>
                                                                    <div class="media">
                                                                        <div class="ldr-img"></div>
                                                                        <div class="media-body">
                                                                            <div class="contents">
                                                                                <div class="ldr-content"></div>
                                                                                <div class="ldr-content"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="media">
                                                                        <div class="ldr-img"></div>
                                                                        <div class="media-body">
                                                                            <div class="contents">
                                                                                <div class="ldr-content"></div>
                                                                                <div class="ldr-content"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="main-comment">
                                                            <div class="media">
                                                                <a href="#" class="user-img popover-cls"
                                                                    data-bs-toggle="popover" data-placement="right"
                                                                    data-name="Pabelo mukrani"
                                                                    data-img="{{asset('user_assets/images/user-sm/2.jpg')}}">
                                                                    <img src="{{asset('user_assets/images/user-sm/2.jpg')}}"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt="user">
                                                                </a>
                                                                <div class="media-body">
                                                                    <a href="#">
                                                                        <h5>Pabelo Mukrani</h5>
                                                                    </a>
                                                                    <p>Oooo Very Cute and Sweet Dog, happy birthday
                                                                        Cuty.... &#128578;
                                                                    </p>
                                                                    <ul class="comment-option">
                                                                        <li><a href="#">like (5)</a></li>
                                                                        <li><a href="#">reply</a></li>
                                                                        <li><a href="#">translate</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="comment-time">
                                                                    <h6>50 mins ago</h6>
                                                                </div>
                                                            </div>
                                                            <div class="sub-comment">
                                                                <div class="media">
                                                                    <a href="#" class="user-img popover-cls"
                                                                        data-bs-toggle="popover" data-placement="right"
                                                                        data-name="sufiya elija"
                                                                        data-img="{{asset('user_assets/images/user-sm/3.jpg')}}">
                                                                        <img src="{{asset('user_assets/images/user-sm/3.jpg')}}"
                                                                            class="img-fluid blur-up lazyload bg-img"
                                                                            alt="user">
                                                                    </a>
                                                                    <div class="media-body">
                                                                        <a href="#">
                                                                            <h5>sufiya elija</h5>
                                                                        </a>
                                                                        <p>Thank You So Much ❤❤</p>
                                                                        <ul class="comment-option">
                                                                            <li><a href="#">like</a></li>
                                                                            <li><a href="#">reply</a></li>
                                                                            <li><a href="#">translate</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="comment-time">
                                                                        <h6>50 mins ago</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="media">
                                                                    <a href="#" class="user-img popover-cls"
                                                                        data-bs-toggle="popover" data-placement="right"
                                                                        data-name="sufiya eliza"
                                                                        data-img="{{asset('user_assets/images/user-sm/4.jpg')}}">
                                                                        <img src="{{asset('user_assets/images/user-sm/4.jpg')}}"
                                                                            class="img-fluid blur-up lazyload bg-img"
                                                                            alt="user">
                                                                    </a>
                                                                    <div class="media-body">
                                                                        <a href="#">
                                                                            <h5>sufiya elija</h5>
                                                                        </a>
                                                                        <p>Thank You So Much ❤❤</p>
                                                                        <ul class="comment-option">
                                                                            <li><a href="#">like</a></li>
                                                                            <li><a href="#">reply</a></li>
                                                                            <li><a href="#">translate</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="comment-time">
                                                                        <h6>50 mins ago</h6>
                                                                    </div>
                                                                </div>
                                                                <a href="javascript:void(0)" class="loader">
                                                                    <i class="iw-15 ih-15" data-feather="rotate-cw"></i>
                                                                    load more replies
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="main-comment">
                                                            <div class="media">
                                                                <a href="#" class="user-img popover-cls"
                                                                    data-bs-toggle="popover" data-placement="right"
                                                                    data-name="pabelo mukrani"
                                                                    data-img="{{asset('user_assets/images/user-sm/2.jpg')}}">
                                                                    <img src="{{asset('user_assets/images/user-sm/2.jpg')}}"
                                                                        class="img-fluid blur-up lazyload bg-img"
                                                                        alt="user">
                                                                </a>
                                                                <div class="media-body">
                                                                    <a href="#">
                                                                        <h5>Pabelo Mukrani</h5>
                                                                    </a>
                                                                    <p>It’s party time, Sufiya..... and happy birthday
                                                                        cuty 🎉🎊
                                                                    </p>
                                                                    <ul class="comment-option">
                                                                        <li><a href="#">like</a></li>
                                                                        <li><a href="#">reply</a></li>
                                                                        <li><a href="#">translate</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="comment-time">
                                                                    <h6>50 mins ago</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="reply">
                                                        <div class="search-input input-style input-lg icon-right">
                                                            <input type="text" class="form-control emojiPicker"
                                                                placeholder="write a comment..">
                                                            <a href="javascript:void(0)">
                                                                <i data-feather="smile"
                                                                    class="icon icon-2 iw-14 ih-14"></i>
                                                            </a>
                                                            <a href="javascript:void(0)">
                                                                <i class="iw-14 ih-14 icon" data-feather="camera"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- share post model start -->
    <div class="modal fade mobile-full-width" id="shareModal" aria-labelledby="shareModal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content share-modal">
                <div class="modal-header">
                    <div class="setting-dropdown">
                        <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                            <h5 data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">share as post <i
                                    class="iw-14" data-feather="chevron-down"></i></h5>
                            <div class="dropdown-menu custom-dropdown">
                                <ul>
                                    <li>
                                        <a href="">share as post</a>
                                    </li>
                                    <li>
                                        <a href="">on friend's feed</a>
                                    </li>
                                    <li>
                                        <a href="">in a group</a>
                                    </li>
                                    <li>
                                        <a href="">share as message</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="#" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x" class="icon-light close-btn"></i></a>
                </div>
                <div class="modal-body">
                    <div class="user-info">
                        <div class="media">
                            <a href="#" class="user-img">
                                <img src="{{asset('user_assets/images/user-sm/2.jpg')}}" class="img-fluid blur-up lazyload bg-img"
                                    alt="user">
                            </a>
                            <div class="media-body">
                                <a href="#">
                                    <h5>Pabelo Mukrani</h5>
                                </a>
                                <div class="setting-dropdown">
                                    <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                        <h6 data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-font-light left-icon iw-12 ih-12"
                                                data-feather="globe"></i>public <i class="iw-14"
                                                data-feather="chevron-down"></i>
                                        </h6>
                                        <div class="dropdown-menu custom-dropdown">
                                            <ul>
                                                <li>
                                                    <a href=""><i class="icon-font-light iw-16 ih-16"
                                                            data-feather="globe"></i>public</a>
                                                </li>
                                                <li>
                                                    <a href=""><i class="icon-font-light iw-16 ih-16"
                                                            data-feather="users"></i>friends</a>
                                                </li>
                                                <li>
                                                    <a href=""><i class="icon-font-light iw-16 ih-16"
                                                            data-feather="user"></i>friends
                                                        except</a>
                                                </li>
                                                <li>
                                                    <a href=""><i class="icon-font-light iw-16 ih-16"
                                                            data-feather="user"></i>specific
                                                        friends</a>
                                                </li>
                                                <li>
                                                    <a href=""><i class="icon-font-light iw-16 ih-16"
                                                            data-feather="lock"></i>only me</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-section">
                        <input type="text" class="form-control emojiPicker" placeholder="write a comment..">
                    </div>
                    <div class="post-section ratio2_1">
                        <div class="post-img">
                            <img src="{{asset('user_assets/images/post/1.jpg')}}" class="img-fluid blur-up lazyload bg-img" alt="">
                        </div>
                        <div class="post-content">
                            <h3>Today Our Three Cute Puppy Dog Birthday !!!!</h3>
                            <h5 class="tag"><span>#ourcutepuppy,</span> #puppy, #birthday, #dog</h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-solid">share post</button>
                </div>
            </div>
        </div>
    </div>
    <!-- share post model end -->
    <!-- add post/story model start -->
    <div class="modal fade" id="addStory" aria-labelledby="addStory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="create-post">
                        <div class="static-section">
                            <div class="card-title">
                                <h3>create post</h3>
                                <ul class="create-option">
                                    <li class="options">
                                        <div class="setting-dropdown">
                                            <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                                <h5 data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    public <i class="iw-14" data-feather="chevron-down"></i></h5>
                                                <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                                    <ul>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="globe"></i>public</a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="users"></i>friends</a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="user"></i>friends
                                                                except</a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="user"></i>specific
                                                                friends</a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                    data-feather="lock"></i>only me</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <h5><i class="iw-15" data-feather="video"></i>go live</h5>
                                    </li>
                                </ul>
                                <div class="settings">
                                    <div class="setting-btn ms-2 setting-dropdown no-bg">
                                        <div class="btn-group custom-dropdown arrow-none dropdown-sm">
                                            <div role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="icon icon-font-color iw-14"
                                                    data-feather="more-horizontal"></i>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-right custom-dropdown">
                                                <ul>
                                                    <li>
                                                        <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                data-feather="edit"></i>edit profile</a>
                                                    </li>
                                                    <li>
                                                        <a href=""><i class="icon-font-light iw-16 ih-16"
                                                                data-feather="user"></i>view profile</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="search-input input-style icon-right">
                                <input type="text" class="form-control enable" placeholder="write something here..">
                                <a href="#">
                                    <img src="{{asset('user_assets/images/icon/translate.png')}}"
                                        class="img-fluid blur-up lazyload icon" alt="translate">
                                </a>
                            </div>
                        </div>
                        <div class="create-bg">
                            <div class="bg-post" id="bg-post1">
                                <div class="input-sec">
                                    <input type="text" class="form-control enable" placeholder="write something here..">
                                    <div class="close-icon">
                                        <a href="javascript:void(0)">
                                            <i class="iw-20 ih-20" data-feather="x"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <ul class="gradient-bg">
                                <li onclick="clickGradient( 'gr-1')" class="gr-1"></li>
                                <li onclick="clickGradient( 'gr-2')" class="gr-2"></li>
                                <li onclick="clickGradient( 'gr-3')" class="gr-3"></li>
                                <li onclick="clickGradient( 'gr-4')" class="gr-4"></li>
                                <li onclick="clickGradient( 'gr-5')" class="gr-5"></li>
                                <li onclick="clickGradient( 'gr-6')" class="gr-6"></li>
                                <li onclick="clickGradient( 'gr-7')" class="gr-7"></li>
                                <li onclick="clickGradient( 'gr-8')" class="gr-8"></li>
                                <li onclick="clickGradient( 'gr-9')" class="gr-9"></li>
                                <li onclick="clickGradient( 'gr-10')" class="gr-10"></li>
                                <li onclick="clickGradient( 'gr-11')" class="gr-11"></li>
                                <li onclick="clickGradient( 'gr-12')" class="gr-12"></li>
                                <li onclick="clickGradient( 'gr-13')" class="gr-13"></li>
                                <li onclick="clickGradient( 'gr-14')" class="gr-14"></li>
                                <li onclick="clickGradient( 'gr-15')" class="gr-15"></li>
                            </ul>
                        </div>
                        <ul class="create-btm-option">
                            <li>
                                <input class="choose-file" type="file">
                                <h5><i class="iw-14" data-feather="camera"></i>album</h5>
                            </li>
                            <li>
                                <h5><i class="iw-15" data-feather="smile"></i>feelings & acitivity</h5>
                            </li>
                            <li>
                                <h5><i class="iw-15" data-feather="map-pin"></i>check in</h5>
                            </li>
                            <li>
                                <h5><i class="iw-15" data-feather="tag"></i>tag friends</h5>
                            </li>
                        </ul>
                        <div id="post-btn1" class="post-btn">
                            <button disabled="disabled" class="Disable">post</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add post/story model end -->

    <!-- theme setting -->
    <div id="setting_box" class="setting-box">
        <a href="javascript:void(0)" class="overlay" onclick="closeSetting()"></a>
        <div class="setting_box_body">
            <div onclick="closeSetting()">
                <div class="sidebar-back text-left"><i class="fa fa-angle-left pe-2" aria-hidden="true"></i> Back</div>
            </div>
            <div class="setting-body">
                <div class="setting-title">
                    <h4>Newsfeed Layout</h4>
                </div>
                <div class="setting-contant">
                    <div class="row demo-section">
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/newsfeed/1.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 1</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('index.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/newsfeed/2.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 2</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('index-2.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/newsfeed/3.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 3</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('index-3.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/newsfeed/4.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 4</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('index-4.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/newsfeed/5.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 5</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('index-5.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/newsfeed/6.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 6</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('index-6.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/newsfeed/7.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 7</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('index-7.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/newsfeed/8.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 8</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('index-8.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/newsfeed/9.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 9</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('index-9.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/newsfeed/10.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 10</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('index-10.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/newsfeed/11.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 11</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('index-11.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/newsfeed/12.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 12</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('index-12.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting-title">
                    <h4>Profile Pages</h4>
                </div>
                <div class="setting-contant">
                    <div class="row demo-section">
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/profile/1.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>timeline</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('profile.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/profile/2.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>about</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('profile-about.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/profile/3.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>friends</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('profile-friends.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/profile/4.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>gallery</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('profile-gallery.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/profile/5.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>acitivity feed</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('profile-activityfeed.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/profile/6.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>tab</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('profile-tab.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/profile/7.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>friend profile</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('profile(friend).html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting-title">
                    <h4>Favourite Page</h4>
                </div>
                <div class="setting-contant">
                    <div class="row demo-section">
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/favourite/1.jpg')}}" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>page listing </h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('page-list.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/favourite/2.jpg')}}" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>page home</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('single-page.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/favourite/3.jpg')}}" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>about</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('single-about.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/favourite/4.jpg')}}" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>review</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('single-reviews.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/favourite/5.jpg')}}" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>gallery</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('single-gallery.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/favourite/6.jpg')}}" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>tab</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('page-tab.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting-title">
                    <h4>other pages</h4>
                </div>
                <div class="setting-contant">
                    <div class="row demo-section">
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/other/events.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>event & calendar</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('event.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/other/birthday.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Birthday</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('birthday.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/other/weather.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>weather</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('weather.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/other/music.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Music</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('music.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/other/events.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>games</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('games.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/other/login.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>login </h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('login.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/other/register.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>register</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('register.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/other/help.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>help & support</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('help-support.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/other/messanger.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>messanger</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('messanger.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/other/setting.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>setting</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('settings.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/other/help.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>help article</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('help-article.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting-title">
                    <h4>Company Pages</h4>
                </div>
                <div class="setting-contant">
                    <div class="row demo-section">
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/company/home.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Home</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('company-home.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/company/about.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>About</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('about-us.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/company/blog.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Blog</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('blog.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/company/blog-details')}}.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Blog details</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('blog-details.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/company/faq.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>FAQ</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('faq.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/company/career.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Career</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('career.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/company/career-details')}}.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Career details</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('career-details.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/company/coming-soon')}}.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>coming soon</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('coming-soon.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/company/404.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>404</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('404.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting-title">
                    <h4>Element Pages</h4>
                </div>
                <div class="setting-contant">
                    <div class="row demo-section">
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/element/typography.jpg')}}"
                                        class="bg-img blur-up lazyload" alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>typography</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('typography.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/element/widget.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>sidebar widgets</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('sidebar-widgets.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/element/calendar.jpg')}}"
                                        class="bg-img blur-up lazyload" alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>calender</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('element-event-calendar.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/element/map.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>maps</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('element-map.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/element/icons.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>icons</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('icons.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/element/modal.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>modal</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('element-modal.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="{{asset('user_assets/images/demo/element/buttons.jpg')}}" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>buttons</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onclick="window.open('element-button.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- theme setting -->


    <!-- latest jquery-->
    <script src="{{asset('user_assets/js/jquery-3.6.0.min.js')}}"></script>

    <!-- popper js-->
    <script src="{{asset('user_assets/js/popper.min.js')}}"></script>

    <!-- slick slider js -->
    <script src="{{asset('user_assets/js/slick.js')}}"></script>
    <script src="{{asset('user_assets/js/custom-slick.js')}}"></script>

    <!-- counter js -->
    <script src="{{asset('user_assets/js/counter.js')}}"></script>

    <!-- popover js for custom popover -->
    <script src="{{asset('user_assets/js/popover.js')}}"></script>

    <!-- feather icon js-->
    <script src="{{asset('user_assets/js/feather.min.js')}}"></script>

    <!-- emoji picker js-->
    <script src="{{asset('user_assets/js/emojionearea.min.js')}}"></script>

    <!-- Bootstrap js-->
    <script src="{{asset('user_assets/js/bootstrap.js')}}"></script>

    <!-- chatbox js -->
    <script src="{{asset('user_assets/js/chatbox.js')}}"></script>

    <!-- lazyload js-->
    <script src="{{asset('user_assets/js/lazysizes.min.js')}}"></script>

    <!-- theme setting js-->
    <script src="{{asset('user_assets/js/theme-setting.js')}}"></script>

    <!-- Theme js-->
    <script src="{{asset('user_assets/js/script.js')}}"></script>

    <script>
    feather.replace();
    $(".emojiPicker").emojioneArea({
        inline: true,
        placement: 'absleft',
        pickerPosition: "top left",
    });
    </script>

</body>

</html>