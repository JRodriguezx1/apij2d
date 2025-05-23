<!--<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace <?php echo validar_string_url('/dashboard')?'dashboard__enlace--actual':''; ?>">
            <i class="fa-solid fa-house"></i>
            <span class="dashboard__menu-texto">inicio</span>
        </a>

        <a href="/admin/servicios" class="dashboard__enlace <?php echo validar_string_url('/servicios')?'dashboard__enlace--actual':''; ?>" >
            <i class="fa-solid fa-list"></i>
            <span class="dashboard__menu-texto">servicios</span>
        </a>

        <a href="/admin/facturacion" class="dashboard__enlace <?php echo validar_string_url('/facturacion')?'dashboard__enlace--actual':''; ?>" >
            <i class="fa-solid fa-credit-card"></i>
            <span class="dashboard__menu-texto">facturacion</span>
        </a>

        <a href="/admin/reportes" class="dashboard__enlace <?php echo validar_string_url('/reportes')?'dashboard__enlace--actual':''; ?>" >
            <i class="fa-solid fa-coins"></i>
            <span class="dashboard__menu-texto">reportes</span>
        </a>

        <a href="/admin/citas" class="dashboard__enlace <?php echo validar_string_url('/citas')?'dashboard__enlace--actual':''; ?>" >
            <i class="fa-solid fa-calendar"></i>
            <span class="dashboard__menu-texto">citas</span>
        </a>

        <a href="/admin/clientes" class="dashboard__enlace <?php echo validar_string_url('/clientes')?'dashboard__enlace--actual':''; ?>" >
            <i class="fa-solid fa-users"></i>
            <span class="dashboard__menu-texto">clientes</span>
        </a>

        <a href="/admin/fidelizacion" class="dashboard__enlace <?php echo validar_string_url('/fidelizacion')?'dashboard__enlace--actual':''; ?>" >
            <i class="fa-solid fa-gift"></i>
            <span class="dashboard__menu-texto">descuentos</span>
        </a>
        <?php //if($user['admin']>2): ?>
        <a href="/admin/adminconfig" class="dashboard__enlace <?php echo validar_string_url('/adminconfig')?'dashboard__enlace--actual':''; ?>" >
            <i class="fa-solid fa-gears"></i>
            <span class="dashboard__menu-texto">administrador</span>
        </a>
        <?php //endif; ?>
    </nav>
</aside>-->

<!--
<aside class="sidebar">
    <div class="uptask">
        <h1 class="font-bold nametop">InterPos</h1>
        <div class="menux">
            <img id="mobile-menux" src="/build/img/cerrar.svg" alt="cerrar menu">
        </div>
    </div>-->
    <!--
    <nav class="sidebar-nav">--> <!-- el tamaño de las letras de los links <a> estan definidos en 1.6rem en gloables.scss -->
        <!--
        <a class="<?php echo ($titulo === 'Inicio')?'activo':''; ?>" href="/admin/dashboard"><span class="material-symbols-outlined">home</span> <label class="btnav"> Inicio</label> </a>
        <a class="<?php echo ($titulo === 'Contabilidad')?'activo':''; ?>" href="/admin/contabilidad"><span class="material-symbols-outlined"> article</span> <label class="btnav"> Informes Contables</label></a>
        <a class="<?php echo ($titulo === 'Almacen')?'activo':''; ?>" href="/admin/almacen"><span class="material-symbols-outlined">warehouse</span> <label class="btnav"> Almacenamiento</label></a>
        <a class="<?php echo ($titulo === 'Caja')?'activo':''; ?>" href="/admin/caja"><span class="material-symbols-outlined">point_of_sale</span> <label class="btnav"> Caja</label></a>
        <a class="<?php echo ($titulo === 'Ventas')?'activo':''; ?>" href="/admin/ventas"><span class="material-symbols-outlined">storefront</span> <label class="btnav"> Ventas</label></a>
        <a class="<?php echo ($titulo === 'Reportes')?'activo':''; ?>" href="/admin/reportes"><span class="material-symbols-outlined">format_list_bulleted</span> <label class="btnav"> Reportes</label></a>
        <a class="<?php echo ($titulo === 'Clientes')?'activo':''; ?>" href="/admin/clientes"><span class="material-symbols-outlined">support_agent</span> <label class="btnav"> Clientes</label></a>
        <a class="<?php echo ($titulo === 'Perfil')?'activo':''; ?>" href="/admin/perfil"><span class="material-symbols-outlined">manage_accounts</span> <label class="btnav"> Perfil</label></a>
        <a class="<?php echo ($titulo === 'Configuracion')?'activo':''; ?>" href="/admin/configuracion"><span class="material-symbols-outlined">settings</span> <label class="btnav"> Configuracion</label></a>
    </nav>
    <div class="cerrar-sesion-mobile">
        <p>Bienvenido: <span> <?php echo $_SESSION['nombre']; ?></span></p>
        <a class="cerrar-sesion" href="/logout">Cerrar Sesion</a>
    </div>
</aside>-->

<aside
    class="fixed top-0 left-0 z-40 w-2xs h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0  "
    aria-label="Sidenav"
    id="drawer-navigation"
    >
      <div class="overflow-y-auto py-5 px-3 h-full bg-white ">
        
        <ul class="space-y-2 pt-4">
          <li>
            <button
              type="button"
              class="flex items-center p-2 w-full text-xl font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100  "
              aria-controls="dropdown-pages"
              data-collapse-toggle="dropdown-pages"
            >
              <svg
                aria-hidden="true"
                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900  "
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
              </svg>
              <span class="flex-1 ml-3 text-left whitespace-nowrap">Configuraciones</span>
              <svg
                aria-hidden="true"
                class="w-6 h-6"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
            <ul id="dropdown-pages" class="hidden py-2 space-y-2">
              <li>
                <a href="/admin/configuracion/company" class="flex items-center p-2 pl-11 w-full text-lg font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100  ">Compañia</a>
              </li>
              
              <li>
                <a href="#" class="flex items-center p-2 pl-11 w-full text-lg font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100  ">Software</a>
              </li>
            </ul>
          </li>
          <li>
            <button
              type="button"
              class="flex items-center p-2 w-full text-xl font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100  "
              aria-controls="dropdown-sales"
              data-collapse-toggle="dropdown-sales"
            >
              <svg
                aria-hidden="true"
                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900  "
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
              </svg>
              <span class="flex-1 ml-3 text-left whitespace-nowrap">Factura</span>
              <svg
                aria-hidden="true"
                class="w-6 h-6"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
            <ul id="dropdown-sales" class="hidden py-2 space-y-2">
              <li>
                <a href="/admin/factura/setdepruebas" class="flex items-center p-2 pl-11 w-full text-lg font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100  ">Set de pruebas</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#" class="flex items-center p-2 text-xl font-medium text-gray-900 rounded-lg  hover:bg-gray-100  group">
              <svg
                aria-hidden="true"
                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75  group-hover:text-gray-900 "
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path>
                <path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path>
              </svg>
              <span class="flex-1 ml-3 whitespace-nowrap">Mensajes</span>
              <span class="inline-flex justify-center items-center w-5 h-5 text-base font-semibold rounded-full text-primary-800 bg-primary-100 dark:bg-primary-200 dark:text-primary-800">4</span>
            </a>
          </li>
          
        </ul>
        <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 ">
          <li>
            <a href="#" class="flex items-center p-2 text-lg font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100   group">
              <svg
                aria-hidden="true"
                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75  group-hover:text-gray-900 "
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
              </svg>
              <span class="ml-3">Docs</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-2 text-lg font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100   group">
              <svg
                aria-hidden="true"
                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75  group-hover:text-gray-900 "
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
              </svg>
              <span class="ml-3">Components</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-2 text-lg font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100   group">
              <svg
                aria-hidden="true"
                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75  group-hover:text-gray-900 "
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"></path>
              </svg>
              <span class="ml-3">Help</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="hidden absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full lg:flex bg-white  z-20">
        <a href="#" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer  hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-600">
          <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path>
          </svg>
        </a>
        <a
          href="#"
          data-tooltip-target="tooltip-settings"
          class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer  dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600"
        >
          <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
          </svg>
        </a>
        <div
          id="tooltip-settings"
          role="tooltip"
          class="inline-block absolute invisible z-10 py-2 px-3 text-lg font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip"
        >
          Settings page
          <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
      </div>
    </aside>