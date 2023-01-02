@extends('includes.app')
@section('content')
<link href='{{asset('assets/calendar/lib/main.css')}}' rel='stylesheet' />
<script src="{{asset('assets/calendar/lib/main.js')}}"></script>

  <style>
  
    body {
      margin: 40px 10px;
      padding: 0;
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }
  
    #calendar {
  
    /* padding: 10px;
      max-width: 1100px;
      margin: 0 auto; */
      top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    }

    /* html, body {
    overflow: hidden;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar-container {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }

  .fc-header-toolbar {
   
    padding-top: 1em;
    padding-left: 1em;
    padding-right: 1em;
  } */


    
  
  </style>


        <!-- Breadcrumbs-->
        <nav class="mb-1 pb-2 border-bottom" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./index.html"><i class="ri-home-line align-bottom me-1"></i> <b class="text-muted">Dashboard</b> </a></li>
            </ol>
        </nav>            <!-- / Breadcrumbs-->

        <!-- Top Row Widgets-->
        <div class="row g-4 mb-4">

            <!-- Schedule Widget-->
            <div class="col-12 col-lg-12">
                    <div class="card h-100">
                        <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                            <h6 class="card-title">Calendar Meeting Schedule</h6>
                            
                            <!-- Nav Pills-->
                            {{-- <ul class="nav nav-pills justify-content-end m-0" id="scheduleTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="today-tab" data-bs-toggle="tab" data-bs-target="#today" type="button" role="tab" aria-controls="today" aria-selected="true">Today</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tomorrow-tab" data-bs-toggle="tab" data-bs-target="#tomorrow" type="button" role="tab" aria-controls="tomorrow" aria-selected="false">Tomorrow</button>
                                </li>
                            </ul> --}}
                            <!-- / Nav Pills-->
                
                        </div>
                        <div class="card-body" style="background-color: #060e4d;">
                            <!-- Tab Content-->
                            <div class="tab-content" id="scheduleTabContent">
                
                                <div id='calendar'></div>
                                <!-- Tab Today Content-->
                                {{-- <div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
                                    <ul class="list-group list-group-flush">
                
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="fw-bolder mb-2 text-white">Sales meeting</p>
                                                    <span class="small d-flex align-items-center"><i class="ri-time-line me-2"></i> 09:35 <i class="ri-map-pin-line ms-6 me-2"></i> Meeting room 32B</span>
                                                </div>
                
                                                <div class="dropdown ms-5">
                                                    <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0"
                                                        type="button" id="dropDownSchedule-0" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="ri-more-2-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown dropdown-menu-end" aria-labelledby="dropDownSchedule-0">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="fw-bolder mb-2 text-white">Interview with Patrick Nelson</p>
                                                    <span class="small d-flex align-items-center"><i class="ri-time-line me-2"></i> 11:45 <i class="ri-map-pin-line ms-6 me-2"></i> Main conference hall</span>
                                                </div>
                
                                                <div class="dropdown ms-5">
                                                    <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0"
                                                        type="button" id="dropDownSchedule-1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="ri-more-2-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown dropdown-menu-end" aria-labelledby="dropDownSchedule-1">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="fw-bolder mb-2 text-white">Weekly API call</p>
                                                    <span class="small d-flex align-items-center"><i class="ri-time-line me-2"></i> 14:00 <i class="ri-map-pin-line ms-6 me-2"></i> Online</span>
                                                </div>
                
                                                <div class="dropdown ms-5">
                                                    <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0"
                                                        type="button" id="dropDownSchedule-2" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="ri-more-2-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown dropdown-menu-end" aria-labelledby="dropDownSchedule-2">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="fw-bolder mb-2 text-white">Design review</p>
                                                    <span class="small d-flex align-items-center"><i class="ri-time-line me-2"></i> 16:35 <i class="ri-map-pin-line ms-6 me-2"></i> Meeting room 12A</span>
                                                </div>
                
                                                <div class="dropdown ms-5">
                                                    <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0"
                                                        type="button" id="dropDownSchedule-3" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="ri-more-2-line"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown dropdown-menu-end" aria-labelledby="dropDownSchedule-3">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                
                                    </ul>
                                </div> --}}
                                <!-- / Tab Today Content-->
                
                                <!-- Tab Tomorrow Content-->
                                {{-- <div class="tab-pane fade" id="tomorrow" role="tabpanel" aria-labelledby="tomorrow-tab">
                                    <ul class="list-group list-group-flush">
                
                                            <li class="list-group-item">
                                                <p class="fw-bolder mb-2 text-white">New product marketing meeting</p>
                                                <span class="small d-flex align-items-center"><i class="ri-time-line me-2"></i> 11:00 <i class="ri-map-pin-line ms-6 me-2"></i> Central London, SW19 7TH</span>
                                            </li>
                                            <li class="list-group-item">
                                                <p class="fw-bolder mb-2 text-white">Design review</p>
                                                <span class="small d-flex align-items-center"><i class="ri-time-line me-2"></i> 13:45 <i class="ri-map-pin-line ms-6 me-2"></i> Meeting room 14B</span>
                                            </li>
                                            <li class="list-group-item">
                                                <p class="fw-bolder mb-2 text-white">Daily SCRUM meeting</p>
                                                <span class="small d-flex align-items-center"><i class="ri-time-line me-2"></i> 15:00 <i class="ri-map-pin-line ms-6 me-2"></i> Online</span>
                                            </li>
                                            <li class="list-group-item">
                                                <p class="fw-bolder mb-2 text-white">Sales meeting</p>
                                                <span class="small d-flex align-items-center"><i class="ri-time-line me-2"></i> 16:35 <i class="ri-map-pin-line ms-6 me-2"></i> Meeting room 12A</span>
                                            </li>
                
                                    </ul>
                                </div> --}}
                                <!-- / Tab Tomorro Content-->
                
                            </div>

                            {{-- <div class="row">


                                <div id='calendar'></div>
                            </div> --}}
                            <!-- / Tab Content-->
                
                        </div>
                    </div>
            </div>
            <!-- / Schedule Widget-->


        </div>
        <!-- Top Row Widgets-->

        <!-- Middle Row Widgets-->
        <div class="row g-4 mb-4">


            {{-- <div id='calendar-container'> --}}
                {{-- <div id='calendar'></div> --}}
              {{-- </div> --}}
            {{-- <!-- Activity Widget-->
            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                        <h6 class="card-title m-0">Recent activity</h6>
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button"
                                id="dropdownActivity" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-line"></i>
                            </button>
                            <ul class="dropdown-menu dropdown" aria-labelledby="dropdownActivity">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                
                            <li class="list-group-item list-group-activity py-3 d-flex align-items-start">
                                <picture class="mt-1 avatar avatar-xs me-4">
                                    <img src="./assets/images/profile-small-7.jpeg" alt="">
                                </picture>
                                <div>
                                    <p class="text-white mb-1">John Doe</p>
                                    <span class="small d-block">Submitted quarterly marketing report for review.</span>
                                    <span class="small d-block">5m ago</span>
                                </div>
                            </li>
                            <li class="list-group-item list-group-activity py-3 d-flex align-items-start">
                                <picture class="mt-1 avatar avatar-xs me-4">
                                    <img src="./assets/images/profile-small-2.jpeg" alt="">
                                </picture>
                                <div>
                                    <p class="text-white mb-1">Sally Field</p>
                                    <span class="small d-block">Marked project status as completed.</span>
                                    <span class="small d-block">1h ago</span>
                                </div>
                            </li>
                            <li class="list-group-item list-group-activity py-3 d-flex align-items-start">
                                <picture class="mt-1 avatar avatar-xs me-4">
                                    <img src="./assets/images/profile-small-3.jpeg" alt="">
                                </picture>
                                <div>
                                    <p class="text-white mb-1">Mark Robinson</p>
                                    <span class="small d-block">Created new sales report export.</span>
                                    <span class="small d-block">2h ago</span>
                                </div>
                            </li>
                            <li class="list-group-item list-group-activity py-3 d-flex align-items-start">
                                <picture class="mt-1 avatar avatar-xs me-4">
                                    <img src="./assets/images/profile-small-4.jpeg" alt="">
                                </picture>
                                <div>
                                    <p class="text-white mb-1">Jeffrey Way</p>
                                    <span class="small d-block">Set user status as &#x27;offline&#x27;</span>
                                    <span class="small d-block">6h ago</span>
                                </div>
                            </li>
                
                        </ul>
                    </div>
                </div>
            </div>
            <!-- / Activity Widget-->

            <!-- Goals Widget-->
            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                        <h6 class="card-title m-0">Goals</h6>
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button"
                                id="dropdownGoals" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-line"></i>
                            </button>
                            <ul class="dropdown-menu dropdown" aria-labelledby="dropdownGoals">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                
                        <div class="mt-3">
                            <div class="form-check goal d-flex align-items-start mb-3 ps-0">
                                <input id="goal-0"
                                    class="form-check-input m-0 d-flex align-self-start me-3 mt-1 cursor-pointer" type="checkbox"
                                     checked>
                                <label class="m-0 d-flex cursor-pointer align-self-start form-check-label"
                                    for="goal-0">Submit yearly sales report for group review</label>
                            </div>
                            <div class="form-check goal d-flex align-items-start mb-3 ps-0">
                                <input id="goal-1"
                                    class="form-check-input m-0 d-flex align-self-start me-3 mt-1 cursor-pointer" type="checkbox"
                                    >
                                <label class="m-0 d-flex cursor-pointer align-self-start form-check-label"
                                    for="goal-1">Do API V2 review with dev team</label>
                            </div>
                            <div class="form-check goal d-flex align-items-start mb-3 ps-0">
                                <input id="goal-2"
                                    class="form-check-input m-0 d-flex align-self-start me-3 mt-1 cursor-pointer" type="checkbox"
                                    >
                                <label class="m-0 d-flex cursor-pointer align-self-start form-check-label"
                                    for="goal-2">Review dashboard redesign with Sarah</label>
                            </div>
                            <div class="form-check goal d-flex align-items-start mb-3 ps-0">
                                <input id="goal-3"
                                    class="form-check-input m-0 d-flex align-self-start me-3 mt-1 cursor-pointer" type="checkbox"
                                    >
                                <label class="m-0 d-flex cursor-pointer align-self-start form-check-label"
                                    for="goal-3">Generate 10% more sales leads through social media</label>
                            </div>
                            <div class="form-check goal d-flex align-items-start mb-3 ps-0">
                                <input id="goal-4"
                                    class="form-check-input m-0 d-flex align-self-start me-3 mt-1 cursor-pointer" type="checkbox"
                                     checked>
                                <label class="m-0 d-flex cursor-pointer align-self-start form-check-label"
                                    for="goal-4">Increase main site pageviews by 25%</label>
                            </div>
                            <div class="form-check goal d-flex align-items-start mb-3 ps-0">
                                <input id="goal-5"
                                    class="form-check-input m-0 d-flex align-self-start me-3 mt-1 cursor-pointer" type="checkbox"
                                    >
                                <label class="m-0 d-flex cursor-pointer align-self-start form-check-label"
                                    for="goal-5">Weekly code review with dev team</label>
                            </div>
                            <div class="form-check goal d-flex align-items-start mb-3 ps-0">
                                <input id="goal-6"
                                    class="form-check-input m-0 d-flex align-self-start me-3 mt-1 cursor-pointer" type="checkbox"
                                    >
                                <label class="m-0 d-flex cursor-pointer align-self-start form-check-label"
                                    for="goal-6">Finish specification for subscription module</label>
                            </div>
                        </div>
                
                    </div>
                
                    <!--  Card Footer -->
                    <div class="card-footer">
                
                        <div class="row align-items-center">
                
                            <!-- New Goal Input -->
                            <div class="col">
                                <textarea class="form-control" rows="1" placeholder="Add new goal"></textarea>
                            </div>
                            <!-- /New Goal Input -->
                
                            <div class="col-auto">
                                <button class="btn btn-sm btn-primary">
                                    Create
                                </button>
                            </div>
                
                        </div>
                    </div>
                    <!-- / Card Footer-->
                
                </div>
            </div>
            <!-- / Goals Widget-->

            <!-- Reminders Widget-->
            <div class="col-12 col-lg-4">
                <div class="card h-100">
                    <div class="card-header justify-content-between align-items-center d-flex border-0 pb-0">
                        <h6 class="card-title m-0">Reminders</h6>
                    </div>
                    <div class="card-body">
                
                        <ul class="list-group list-group-flush">
                
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                
                                <div class="d-flex align-items-start">
                                    <button class="btn btn-icon bg-danger-faded text-danger me-3">
                                        <i class="ri-alert-line"></i>
                                    </button>
                                    <div>
                                        <p class="fw-bolder mb-2 text-white">Annual sales report due</p>
                                        <span class="small d-flex align-items-center"><i class="ri-calendar-line me-2"></i> 21st Aug, 2021</span>
                                    </div>
                                </div>
                
                                <div class="dropdown ms-5">
                                    <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button"
                                        id="dropDownReminder-0" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown dropdown-menu-end" aria-labelledby="dropDownReminder-0">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                
                                <div class="d-flex align-items-start">
                                    <button class="btn btn-icon bg-warning-faded text-warning me-3">
                                        <i class="ri-user-line"></i>
                                    </button>
                                    <div>
                                        <p class="fw-bolder mb-2 text-white">Quarterly staff reviews</p>
                                        <span class="small d-flex align-items-center"><i class="ri-calendar-line me-2"></i> 24th Aug, 2021</span>
                                    </div>
                                </div>
                
                                <div class="dropdown ms-5">
                                    <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button"
                                        id="dropDownReminder-1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown dropdown-menu-end" aria-labelledby="dropDownReminder-1">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                
                                <div class="d-flex align-items-start">
                                    <button class="btn btn-icon bg-info-faded text-info me-3">
                                        <i class="ri-user-line"></i>
                                    </button>
                                    <div>
                                        <p class="fw-bolder mb-2 text-white">Jenny Smith holiday</p>
                                        <span class="small d-flex align-items-center"><i class="ri-calendar-line me-2"></i> 27th Aug, 2021</span>
                                    </div>
                                </div>
                
                                <div class="dropdown ms-5">
                                    <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button"
                                        id="dropDownReminder-2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown dropdown-menu-end" aria-labelledby="dropDownReminder-2">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                
                                <div class="d-flex align-items-start">
                                    <button class="btn btn-icon bg-secondary-faded text-secondary me-3">
                                        <i class="ri-computer-line"></i>
                                    </button>
                                    <div>
                                        <p class="fw-bolder mb-2 text-white">Marketing budget review</p>
                                        <span class="small d-flex align-items-center"><i class="ri-calendar-line me-2"></i> 2nd Sep, 2021</span>
                                    </div>
                                </div>
                
                                <div class="dropdown ms-5">
                                    <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button"
                                        id="dropDownReminder-3" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown dropdown-menu-end" aria-labelledby="dropDownReminder-3">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                
                                <div class="d-flex align-items-start">
                                    <button class="btn btn-icon bg-secondary-faded text-secondary me-3">
                                        <i class="ri-computer-line"></i>
                                    </button>
                                    <div>
                                        <p class="fw-bolder mb-2 text-white">Developer contract renewal</p>
                                        <span class="small d-flex align-items-center"><i class="ri-calendar-line me-2"></i> 10th Sep, 2021</span>
                                    </div>
                                </div>
                
                                <div class="dropdown ms-5">
                                    <button class="btn btn-link dropdown-toggle dropdown-toggle-icon fw-bold p-0" type="button"
                                        id="dropDownReminder-4" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown dropdown-menu-end" aria-labelledby="dropDownReminder-4">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </li>
                
                        </ul>
                    </div>
                </div>
            </div> --}}

        </div>
 
        <script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/action/dashboard.js')}}" type="text/javascript"></script>

@endsection


