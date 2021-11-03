<!-- Page Sidebar Start-->
<div class="page-sidebar" x-data="sidebarMenu()">
   <div class="main-header-left d-none d-lg-block">
      <div class="logo-wrapper"><a href="/"><img src="@asset(config('options.logo_path'))" alt="{{ config('app.name') }}"></a></div>
   </div>
   <div class="sidebar custom-scrollbar">
      <ul class="sidebar-menu">
         <li>
            <a class="sidebar-header" href="/admin" >
               <i data-feather="home"></i>
               <span>Dashboard</span>
            </a>
         </li>
         <template x-for="menuItem in menus">
            <li >
               <a x-bind:href="menuItem.to" class="sidebar-header">
                  <i data-feather="home"></i>
                  <span x-text="menuItem.label"></span>
               </a>
            </li>
         </template>
      </ul>
   </div>
</div>
<!-- Page Sidebar Ends-->
@push('js')
<script>
   function sidebarMenu() {
      const menus = @json($menus);

      return {
         menus
      }
   }
</script>
@endpush
