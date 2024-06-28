<!DOCTYPE html>
<html data-navigation-type="default" data-navbar-horizontal-shape="default" lang="en-US" dir="ltr">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>

    {{-- Inclure les balise meta --}}
    @include('collaborators.include.meta')

    {{-- Donner la possibilité à chaque classe fille d'avoir son propre titre --}}
    <title>PLANIFY || @yield('title')</title>


    {{-- Inclure le fichier contenant les liens css --}}
    @include('collaborators.include.style')

    {{-- Donner la possiblité aux classes filles d'avoir leur propres css --}}
    @yield('css')


  </head>

  <body>
    <main class="main" id="top">
      {{-- Inclure le sidebar --}}
      @include('collaborators.partial.sidebar')


      {{-- Inclure la topbar --}}
      @include('collaborators.partial.topbar')


        {{-- Inclure la bar de recherche --}}
      @include('collaborators.partial.search')


      {{-- Appel au contenu de la page qui se trouvera dans une classe fille --}}
      @yield('content')


    </main>

    {{-- Inclure le fichier custumize.blade.php --}}
    @include('collaborators.partial.customize')

    @include('collaborators.partial.chat')

    {{-- Inclure le fichier contenant les chemins des scripts --}}
    @include('collaborators.include.script')
    @yield('js')
  </body>
</html>
