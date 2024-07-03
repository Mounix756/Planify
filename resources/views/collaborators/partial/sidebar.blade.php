<nav class="navbar navbar-vertical navbar-expand-lg" style="display:none;">
    <script>
      var navbarStyle = window.config.config.phoenixNavbarStyle;
      if (navbarStyle && navbarStyle !== 'transparent') {
        document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
      }
    </script>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
      <!-- scrollbar removed-->
      <div class="navbar-vertical-content">
        <ul class="navbar-nav flex-column" id="navbarVerticalNav">
          <li class="nav-item">
            <!-- parent pages-->
            <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-home" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="nv-home">
                <div class="d-flex align-items-center">
                  <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span class="nav-link-icon"><span data-feather="pie-chart"></span></span><span class="nav-link-text">Accueil</span>
                </div>
              </a>
              <div class="parent-wrapper label-1">
                <ul class="nav collapse parent show" data-bs-parent="#navbarVerticalCollapse" id="nv-home">
                  <li class="collapsed-nav-item-title d-none">Accueil</li>
                  <li class="nav-item"><a class="nav-link active" href="{{route('my_meet')}}" data-bs-toggle="" aria-expanded="false">
                      <div class="d-flex align-items-center"><span class="nav-link-text">Mes reunions</span></div>
                    </a><!-- more inner pages-->
                  </li>
                  <li class="nav-item"><a class="nav-link" href="{{route('collaborator_tasks')}}" data-bs-toggle="" aria-expanded="false">
                      <div class="d-flex align-items-center"><span class="nav-link-text">Mes tâches</span></div>
                    </a><!-- more inner pages-->
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <!-- label-->
            <p class="navbar-vertical-label">GESTION</p>
            <hr class="navbar-vertical-line" /><!-- parent pages-->
            <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-CRM" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-CRM">
                <div class="d-flex align-items-center">
                  <div class="dropdown-indicator-icon">
                    <span class="fas fa-caret-right"></span>
                  </div>
                  <span class="nav-link-icon">
                    <span data-feather="phone"></span>
                  </span>
                  <span class="nav-link-text">Collaborateurs</span>
                </div>
              </a>
              <div class="parent-wrapper label-1">
                <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-CRM">
                  <li class="collapsed-nav-item-title d-none">Collaborateurs</li>
                  <li class="nav-item"><a class="nav-link" href="{{route('my_collaborator')}}" data-bs-toggle="" aria-expanded="false">
                      <div class="d-flex align-items-center"><span class="nav-link-text">Collaborateurs</span></div>
                    </a><!-- more inner pages-->
                  </li>
                </ul>
              </div>
            </div><!-- parent pages-->
            <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-project-management" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-project-management">
                <div class="d-flex align-items-center">
                  <div class="dropdown-indicator-icon">
                    <span class="fas fa-caret-right"></span>
                  </div>
                  <span class="nav-link-icon">
                    <span data-feather="clipboard"></span>
                </span><span class="nav-link-text">Tâches</span>
                </div>
              </a>
              <div class="parent-wrapper label-1">
                <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-project-management">
                  <li class="collapsed-nav-item-title d-none">Tâches</li>
                  <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="" aria-expanded="false">
                      <div class="d-flex align-items-center"><span class="nav-link-text">Tâches terminés</span></div>
                    </a><!-- more inner pages-->
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('collaborator_tasks') }}" data-bs-toggle="" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-text">Mes taches</span>
                        </div>
                    </a>
                </li>
                </ul>
              </div>
            </div><!-- parent pages-->


            <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-kanban" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-kanban">
                <div class="d-flex align-items-center">
                  <div class="dropdown-indicator-icon">
                    <span class="fas fa-caret-right"></span>
                  </div>
                  <span class="nav-link-icon">
                    <span data-feather="trello"></span>
                  </span>
                  <span class="nav-link-text">Réunions</span>
                </div>
              </a>
              <div class="parent-wrapper label-1">
                <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-kanban">
                  <li class="collapsed-nav-item-title d-none">Réunions</li>
                  <li class="nav-item"><a class="nav-link" href="{{route('my_meet')}}" data-bs-toggle="" aria-expanded="false">
                      <div class="d-flex align-items-center"><span class="nav-link-text">Mes réunions</span></div>
                    </a><!-- more inner pages-->
                  </li>
                  <li class="nav-item"><a class="nav-link" href="{{route('my_meet')}}" data-bs-toggle="" aria-expanded="false">
                      <div class="d-flex align-items-center"><span class="nav-link-text">Prochaine réunions</span></div>
                    </a><!-- more inner pages-->
                  </li>
                  {{--<li class="nav-item"><a class="nav-link" href="apps/kanban/create-kanban-board.html" data-bs-toggle="" aria-expanded="false">
                      <div class="d-flex align-items-center"><span class="nav-link-text">Create board</span></div>
                    </a><!-- more inner pages-->
                  </li>--}}
                </ul>
              </div>
            </div><!-- parent pages-->
            <div class="nav-item-wrapper"><a class="nav-link dropdown-indicator label-1" href="#nv-social" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-social">
                <div class="d-flex align-items-center">
                  <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span class="nav-link-icon"><span data-feather="share-2"></span></span><span class="nav-link-text">Dossiers</span>
                </div>
              </a>
              <div class="parent-wrapper label-1">
                <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-social">
                  <li class="collapsed-nav-item-title d-none"></li>
                  <li class="nav-item"><a class="nav-link" href="" data-bs-toggle="" aria-expanded="false">
                      <div class="d-flex align-items-center"><span class="nav-link-text">Mes dossiers</span></div>
                    </a><!-- more inner pages-->
                  </li>
                  <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="" aria-expanded="false">
                      <div class="d-flex align-items-center"><span class="nav-link-text">Tous les dossiers</span></div>
                    </a><!-- more inner pages-->
                  </li>
                </ul>
              </div>
            </div><!-- parent pages-->
            <div class="nav-item-wrapper"><a class="nav-link label-1" href="apps/calendar.html" role="button" data-bs-toggle="" aria-expanded="false">
                <div class="d-flex align-items-center"><span class="nav-link-icon"><span data-feather="calendar"></span></span><span class="nav-link-text-wrapper"><span class="nav-link-text">Calendrier</span></span></div>
              </a></div>
          </li>
        </ul>
      </div>
    </div>
    <div class="navbar-vertical-footer"><button class="btn navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center"><span class="uil uil-left-arrow-to-left fs-8"></span><span class="uil uil-arrow-from-right fs-8"></span><span class="navbar-vertical-footer-text ms-2">Collapsed View</span></button></div>
  </nav>
