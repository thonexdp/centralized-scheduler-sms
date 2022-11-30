
        <!-- Footer -->
        <footer class="  footer">
            <p class="small text-muted m-0">Centralized Scheduler and Notifications System @ <?= date('Y') ?></p>
        </footer>
        
        
        <!-- Sidebar Menu Overlay-->
        <div class="menu-overlay-bg"></div>
        <!-- / Sidebar Menu Overlay-->
        
        <!-- Modal Imports-->
        <!-- Place your modal imports here-->
        
        <!-- Default Example Modal Import-->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Here goes modal body content
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        <!-- Offcanvas Imports-->
        <!-- Place your offcanvas imports here-->
        
        <!-- Default Example Offcanvas Import-->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <div>
                Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
              </div>
              <div class="dropdown mt-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                  Dropdown button
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </div>
            </div>
          </div>
        <!-- Navbar Notifications offcanvas-->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNotifications"
          aria-labelledby="offcanvasNotificationsLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNotificationsLabel">Notifications</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
        
            <!-- Notification-->
            <div class="d-flex justify-content-start align-items-start p-3 rounded bg-light mb-3">
              <div class="position-relative mt-1 ">
                {{-- <picture class="avatar avatar-sm">
                  <img src="./assets/images/profile-small-2.jpeg"
                    alt="HTML Bootstrap Admin Template by Pixel Rocket">
                </picture> --}}
                {{-- <span
                class="dot bg-success avatar-dot border-light dot-sm"></span> --}}
              </div>
              <div class="ms-4 notifications-meeting-description">
                {{-- <p class="fw-bolder mb-1">Juan Dela Cruz</p> --}}
               
              </div>
            </div>
            <!-- / Notification-->

        
          </div>
        </div>            <!-- / Footer-->
