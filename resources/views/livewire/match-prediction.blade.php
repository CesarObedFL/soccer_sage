<div>
    <div class="relative p-4 w-full max-w-2xl">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
            <h3 class="text-xl font-semibold text-gray-900">
                Match Prediction : {{ $fixture }}
            </h3>
            <button wire:click="close" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <div class="p-4 md:p-5 space-y-4">
            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                <ul class="space-y-4 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <li>
                        Winner
                        <ol class="ps-5 mt-2 space-y-1 list-decimal list-inside">
                            <li>{{ $prediction->winner->name }}</li>
                            <li>{{ $prediction->winner->comment }}</li>
                        </ol>
                    </li>
                    <li>
                        Percents
                        <ul class="ps-5 mt-2 space-y-1 list-decimal list-inside">
                            <li>Home: {{ $prediction->percent->home }}</li>
                            <li>Draw: {{ $prediction->percent->draw }}</li>
                            <li>Away: {{ $prediction->percent->away }}</li>
                        </ul>
                    </li>
                    <li>
                        Advice
                        <ul class="ps-5 mt-2 space-y-1 list-decimal list-inside">
                            <li>{{ $prediction->advice }}</li>
                        </ul>
                    </li>
                    <li>
                        Goals
                        <ul class="ps-5 mt-2 space-y-1 list-decimal list-inside">
                            <li>Home: {{ $prediction->goals->home }}</li>
                            <li>Away: {{ $prediction->goals->away }}</li>
                        </ul>
                    </li>
                </ul>
            </p>
        </div>
        <!-- Modal footer -->
        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
            <button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
            <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
        </div>
    </div>
</div>
