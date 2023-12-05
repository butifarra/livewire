<div>
    <section class="flex flex-col items-center space-y-4 py-12">
        <h1 class="text-3xl font-bold underline">
            {{$welcome}} {{-- Variable creada en el componente Main.php --}}
        </h1>
        @if(session()->has('message'))
        {{-- Esas son clases de tailwind
        bg-blue background azul intensidad 400
        fuente negrita
        margin bottom 4
        padding 2
        bordes redondeados
        texto centrado
        texto sm pequeño
        texto blanco
        w-1/3 es 1/3 de anchura
            --}}
        <h3 class="bg-blue-400 font-bold mb-4 p-2 w-1/3 rounded text-center text-sm text-white">{{session('message')}}</h3>
        @endif

      @livewire('task')
    </section>
</div>
