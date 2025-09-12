<div class="w-full">
    <nav class="w-full">
        <ul class="flex justify-center space-x-12 text-lg">
            <li><a class="{{ Route::is('home') ? 'bg-[#243A69] text-[#F4F4F2] p-2 rounded' : 'text-[#243A69] hover:bg-[#D4CDC5] p-2 rounded' }}" href="{{ route('home') }}">Inicío</a></li>
            <li><a class="{{ Route::is('forum') ? 'bg-[#243A69] text-[#F4F4F2] p-2 rounded' : 'text-[#243A69] hover:bg-[#D4CDC5] p-2 rounded' }}" href="{{ route('forum') }}">Fórum</a></li>
            <li><a class="{{ Route::is('#') ? 'bg-[#243A69] text-[#F4F4F2] p-2 rounded' : 'text-[#243A69] hover:bg-[#D4CDC5] p-2 rounded' }}" href="#">Todos os Itens</a></li>
        </ul>
    </nav>

    <hr class="border-t-6 border-[#243A69] w-full mt-4 mb-6">
</div>