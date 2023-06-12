<!-- Main modal -->
<div id="updateEvent" name="Modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed z-50 justify-center items-center w-full inset-0 h-ful backdrop-blur-md bg-slate-800 bg-opacity-10">
    <div class="flex flex-row items-center justify-center p-4 w-full h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 ">
                <h3 class="text-lg font-semibold text-gray-900 ">
                    Event Details
                </h3>

                <button name="m-close" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="flex flex-col space-y-5">
                <form class="flex justify-center" action="{{route('event.live')}}" method="post">
                    @csrf
                    <button type="submit" class="text-black inline-flex items-center bg-green-300 hover:bg-green-200 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        <span class="text-white font-semibold text-lg">Go Live!</span>
                    </button>
                    <input type="hidden" id="idd" name="id">
                </form>
                <form id="eventForm" action="{{route('event.edit')}}" method="post">
                    @csrf
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for=" name" class="block mb-2 text-sm font-medium text-gray-900 ">Event Name</label>
                            <input id="name-inp" type="text" name="name" required id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">
                        </div>
                        <div>
                            <label for=" capacity" class="block mb-2 text-sm font-medium text-gray-900 ">Capacity</label>
                            <input id="capacity" name="capacity" type="number" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ">
                        </div>

                        <div class="col-span-2 relative">
                            <label for="trainee" class="block mb-2 text-sm font-medium text-gray-900 ">Add More Trainees</label>
                            <button id="CheckboxButton" data-dropdown-toggle="dropdownDefaultCheckbox" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"> -- Select -- <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg></button>

                            <!-- Dropdown menu -->
                            <div id="DefaultCheckbox" class="col-span-2 inset-0 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul id="dropDownULL" class=" w-full bg-white absolute p-3 space-y-3 text-sm text-gray-700 " aria-labelledby="dropdownCheckboxButton">
                                </ul>
                            </div>
                        </div>
                        <div class=" sm:col-span-2">
                            <label for="desc" class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                            <textarea id="desc" name="desc" required rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 here"></textarea>
                        </div>
                        <input type="hidden" id="id" name="id">
                    </div>

                    <button type="submit" class="text-black inline-flex items-center bg-blue-200 hover:bg-blue-100 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Submit
                    </button>
                </form>
            </div>
            <!-- id 	name 	description 	location 	capacity 	date 	start_time 	end_time 	status 	uni_id 	topic_id 	created_at 	updated_at -->


        </div>
    </div>
</div>