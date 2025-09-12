<x-app-layout>
    <div class="flex py-2 px-3 rounded-md border-2 border-[#243a69] overflow-hidden max-w-md mx-auto">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
          class="fill-gray-600 mr-3 rotate-90">
          <path
            d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
          </path>
        </svg>
        <input type="email" placeholder="Buscar..." class="w-full outline-none bg-transparent text-gray-600 text-sm border-none focus:ring-0" />
    </div>
    <div class="px-2 md:px-12">
        <h1 class="text-3xl font-bold family-poppins text-[#243a69] mb-6">Ultimos posts</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Cards -->
            <div class="w-full lg:max-w-full lg:flex bg-white rounded shadow h-auto transform transition duration-300 hover:scale-105">
                <div class="border border-[#243a69] h-48 lg:h-auto lg:w-48 flex-none bg-contain bg-no-repeat bg-center  lg:rounded-l text-center overflow-hidden" 
                    style="background-image: url('https://m.media-amazon.com/images/I/51ml18u5yxL._AC_SX679_.jpg')" 
                    title="Item perdido">
                </div>
                <div class="border border-[#243a69] lg:border-l-0 bg-[#243a69] rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                    <div class="mb-8">
                        <div class="text-[#D4CDC5] font-bold text-xl mb-2">Item tal</div>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li class="text-[#D4CDC5]"><span class="text-[#F4F4F2] font-semibold">Local:</span> Sala 203 - Prédio A</li>
                            <li class="text-[#D4CDC5]"><span class="text-[#F4F4F2] font-semibold">Data da coleta:</span> 12/09/2025</li>
                            <li class="text-[#D4CDC5]"><span class="text-[#F4F4F2] font-semibold">Horário de funcionamento:</span> 08:00 - 18:00</li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
