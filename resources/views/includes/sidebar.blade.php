


<aside class="aside bg-dark-700"> 
    <div class="simplebar-wrapper">
        <div data-pixr-simplebar>
            <div class="pb-6 pb-sm-0 position-relative">

                <!-- Mobile close btn-->
                <div class="cursor-pointer close-menu me-4 text-primary-hover transition-color disable-child-pointer position-absolute end-0 top-0 mt-3 pt-1 d-xl-none">
                    <i class="ri-close-circle-line ri-lg align-middle me-n2"></i>
                </div>
                <!-- / Mobile close btn-->

                <!-- Mobile Logo-->
                <div class="d-flex justify-content-center align-items-center py-3">
                    <a class="m-0" href="./index.html">
                        <div class="d-flex align-items-center justify-content-center">
                            <span class="fw-bold fs-3 text-white">CSNS</span>
                        </div>                    </a>
                </div>
                <!-- / Mobile Logo-->

                <!-- User Details-->
                <div class="border-bottom pt-3 pb-2 mb-2 d-flex flex-column align-items-center">
                    <div class="position-relative">
                        <picture class="avatar avatar-profile">
                            {{-- <img class="avatar-profile-img" src="./assets/images/profile-small.jpeg" --}}
                            <img class="avatar-profile-img" src=" {{ empty(session('photo'))?asset('assets/images/profile1.jpg'):asset('storage/'.session('photo'))}}"
                              alt="HTML Bootstrap Admin Template by Pixel Rocket">
                        </picture>
                        <span class="dot bg-success avatar-dot"></span>
                    </div>
                    <p class="mb-0 mt-3 text-white">{{ session('name') }}</p>
                    {{-- <small>robert.jones@outlook.com</small> --}}
                    <div class="d-flex flex-wrap mt-2 justify-content-between align-items-center">
                        {{-- <div class="py-2 f-h-9 px-3 d-flex justify-content-center align-items-center bg-dark-opacity rounded p-2 small fw-bolder me-1">
                            <i class="ri-map-pin-line me-2"></i> London, UK
                        </div> --}}

                        <!-- User profile dropdown-->
                        <div class="dropdown m-0">
                            <button class="border-0 rounded px-2 f-h-9 bg-dark-opacity p-0 text-body" type="button" id="profileDropdown"
                              data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="ri-settings-2-line"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                              {{-- <li><a class="dropdown-item d-flex align-items-center edit-my-profile" data-id="{{session('userid')}}" href="#"><i class="ri-user-line me-2"></i> Edit
                                  profile</a></li> --}}
                              {{-- <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="ri-settings-2-line me-2"></i> Edit
                                  settings</a></li>
                              <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="ri-mail-open-line me-2"></i> Role {{ session('userole') }}</a></li> --}}
                              {{-- <li>
                                <hr class="dropdown-divider">
                              </li> --}}
                              <li><a class="dropdown-item text-danger d-flex align-items-center" href="/logout"><i
                                    class="ri-lock-line me-2"></i> Logout</a></li>
                            </ul>
                          </div>
                        <!-- / User profile dropdown-->
                    </div>
                </div>
                <!-- User Details-->

                <ul class="list-unstyled mb-2 aside-menu">
        
                    <!-- Dashboard Menu Section-->
                    <li class="menu-section">Menu</li>
                    <li class="menu-item"><a class="d-flex align-items-center menu-link" href="/dashboard"><i class="ri-home-4-line me-3"></i> <span>Dashboard</span></a></li>
                    @if(session('userole') == 'clerk' or session('userole') == 'sadmin')
                    <li class="menu-item"><a class="d-flex align-items-center menu-link" href="/meeting"><i class="ri-calendar-line me-3"></i> <span>Events</span></a></li>
                    @endif
                    @if(session('userole') == 'sadmin')
                    <li class="menu-item"><a class="d-flex align-items-center menu-link" href="/employee"><i class="ri-group-line me-3"></i> <span>Employee</span></a></li>
                    <li class="menu-item"><a class="d-flex align-items-center menu-link" href="/department"><i class="ri-building-4-line me-3"></i> <span>Department</span></a></li>
                   @endif
                   <li class="menu-item"><a class="d-flex align-items-center menu-link" href="/participants"><i class="ri-team-line me-3"></i> <span>Participants</span></a></li>
                </ul>
            </div>
        </div>
    </div>

</aside>    <!-- / Page Aside-->

