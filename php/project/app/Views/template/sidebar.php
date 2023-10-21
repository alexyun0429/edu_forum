<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #fbfbfb;
        }
        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0; /* Height of navbar */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }
        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }
    </style>
</head>

<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white fixed-bottom">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <!-- Collapse 1 -->
        <a class="list-group-item list-group-item-action py-2 ripple" aria-current="true"
          data-mdb-toggle="collapse" href="#collapseExample1" aria-expanded="true"
          aria-controls="collapseExample1">
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Expanded menu</span>
        </a>
        <!-- Collapsed content -->
        <ul id="collapseExample1" class="collapse show list-group list-group-flush">
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
        </ul>
        <!-- Collapse 1 -->

        <!-- Collapse 2 -->
        <a class="list-group-item list-group-item-action py-2 ripple" aria-current="true"
          data-mdb-toggle="collapse" href="#collapseExample2" aria-expanded="true"
          aria-controls="collapseExample2">
          <i class="fas fa-chart-area fa-fw me-3"></i><span>Collapsed menu</span>
        </a>
        <!-- Collapsed content -->
        <ul id="collapseExample2" class="collapse list-group list-group-flush">
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
          <li class="list-group-item py-1">
            <a href="" class="text-reset">Link</a>
          </li>
        </ul>
        <!-- Collapse 2 -->
      </div>
    </div>
  </nav>