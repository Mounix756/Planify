<!DOCTYPE html>
<html data-navigation-type="default" data-navbar-horizontal-shape="default" lang="en-US" dir="ltr">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>

    {{-- Inclure les balise meta --}}
    @include('managers.include.meta')

    {{-- Donner la possibilité à chaque classe fille d'avoir son propre titre --}}
    <title>SCHOOL || @yield('title')</title>


    {{-- Inclure le fichier contenant les liens css --}}
    @include('managers.include.style')

    {{-- Donner la possiblité aux classes filles d'avoir leur propres css --}}
    @yield('css')


  </head>

  <body>
    <main class="main" id="top">
      {{-- Inclure le sidebar --}}
      @include('managers.partial.sidebar')


      {{-- Inclure la topbar --}}
      @include('managers.partial.topbar')


        {{-- Inclure la bar de recherche --}}
      @include('managers.partial.search')


      {{-- Appel au contenu de la page qui se trouvera dans une classe fille --}}
      @yield('content')


    </main>

    {{-- Inclure le fichier custumize.blade.php --}}
    @include('managers.partial.customize')

    @include('managers.partial.chat')

    {{-- Inclure le fichier contenant les chemins des scripts --}}
    @include('managers.include.script')
    @yield('js')
  </body>
</html>
