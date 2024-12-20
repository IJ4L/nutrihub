<div id="reservation" class="mb-28 md:mt-24 lg:h-screen flex flex-col justify-center items-center">
    <div data-aos="flip-down" class="text-center max-w-screen-md mx-auto">
        <h1 class="text-3xl font-bold mb-4">Reservation <span class="text-orange">interest?</span></h1>
        <p class="text-gray-500">Skilline is a platform that allows educators to create online classes whereby they can
            store the course materials online; manage assignments, quizzes, and exams; monitor due dates; grade results
            and provide students with feedback all in one place.</p>
    </div>

    <div data-aos="fade-up"
        class="flex flex-col md:flex-row justify-center space-y-5 md:space-y-0 md:space-x-6 lg:space-x-10 mt-7">
        <!-- Outdoor Room Card -->
        <div id="1" class="card relative md:w-5/12 cursor-pointer" data-tooltip="Outdoor Room"
            onclick="showTable('1', 'table')" role="button" aria-label="Outdoor Room">
            <img class="rounded-2xl md:h-72 object-cover" src="{{ asset('images/outdoor.jpg') }}" alt="Outdoor Room">
        </div>
        <!-- Indoor Room Card -->
        <div id="2" class="card relative md:w-5/12 cursor-pointer" data-tooltip="Indoor Room"
            onclick="showTable('2', 'table')" role="button" aria-label="Indoor Room">
            <img class="rounded-2xl md:h-72 object-cover" src="{{ asset('images/indoor_2.jpg') }}" alt="Indoor Room">
        </div>
        <!-- Studio Room Card -->
        <div id="3" class="card relative md:w-5/12 cursor-pointer" data-tooltip="Studio Room"
            onclick="showTable('3', 'table')" role="button" aria-label="Studio Room">
            <img class="rounded-2xl md:h-72 object-cover" src="{{ asset('images/studio.jpg') }}" alt="Studio Room">
        </div>
    </div>

    <div id="table" class="hidden mt-4">
        <div class="max-w-screen-lg shadow-lg mx-auto flex flex-col md:flex-row">
            <div class="md:p-8 p-5 dark:bg-gray-800 bg-white rounded-t">
                <div class="px-2 flex items-center justify-between">
                    <!-- Dynamic Month and Year Display -->
                    <span id="monthYear"
                        class="focus:outline-none text-base font-bold dark:text-gray-100 text-gray-800"></span>
                    <div class="flex items-center">
                        <button onclick="prevMonth()" id="prevMonth"
                            class="focus:text-gray-400 hover:text-gray-400 text-gray-800 dark:text-gray-100"
                            aria-label="Previous month">←</button>
                        <button onclick="nextMonth()" id="nextMonth"
                            class="focus:text-gray-400 hover:text-gray-400 ml-3 text-gray-800 dark:text-gray-100"
                            aria-label="Next month">→</button>
                    </div>
                </div>
                <div class="flex items-center justify-between pt-12 overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr>
                                @foreach (['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'] as $day)
                                    <th>
                                        <div class="w-full flex justify-center">
                                            <p
                                                class="text-base font-medium text-center text-gray-800 dark:text-gray-100">
                                                {{ $day }}</p>
                                        </div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody id="calendarBody"></tbody>
                    </table>
                </div>
            </div>

            <div class="md:py-8 py-5 md:w-96 md:px-10 px-5 dark:bg-gray-700 bg-gray-50 rounded-b relative">
                <div class="absolute -top-4 -right-3 h-8 w-8 bg-red-nut rounded-full cursor-pointer flex justify-center items-center"
                    onclick="showCards('table')" role="button" aria-label="Close calendar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="px-4">
                    <p id="clickedDateDisplay" class="mt-5"></p>
                    <div id="reservationsDisplay" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedCardId = null;
        const reservationsData = @json($reservations);
        let selectedDate = null;

        function showTable(clickedCardId, tableId) {
            selectedCardId = clickedCardId;
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => card.classList.add('hidden'));
            document.getElementById(tableId).classList.remove('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const monthYear = document.getElementById('monthYear');
            const calendarBody = document.getElementById('calendarBody');
            const prevMonth = document.getElementById('prevMonth');
            const nextMonth = document.getElementById('nextMonth');
            const clickedDateDisplay = document.getElementById('clickedDateDisplay');

            let currentDate = new Date();
            let currentYear = currentDate.getFullYear();
            let currentMonth = currentDate.getMonth();

            function formatDate(date) {
                const month = (date.getMonth() + 1).toString().padStart(2, '0');
                const day = date.getDate().toString().padStart(2, '0');
                const year = date.getFullYear();
                return `${year}-${month}-${day}`;
            }

            function renderCalendar() {
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();
                const firstDayOfMonth = new Date(year, month, 1).getDay();
                const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
                const lastDayOfLastMonth = new Date(year, month, 0).getDate();

                monthYear.textContent = currentDate.toLocaleDateString('default', {
                    month: 'long',
                    year: 'numeric'
                });

                calendarBody.innerHTML = '';
                let date = 1;
                let nextMonthDate = 1;
                for (let i = 0; i < 6; i++) {
                    let row = document.createElement('tr');
                    for (let j = 0; j < 7; j++) {
                        let cell = document.createElement('td');
                        let cellText = '';

                        if (i === 0 && j < (firstDayOfMonth + 6) % 7) {
                            cellText = lastDayOfLastMonth - (firstDayOfMonth + 6) % 7 + j + 1;
                            cell.classList.add('text-gray-400');
                        } else if (date > lastDateOfMonth) {
                            cellText = nextMonthDate++;
                            cell.classList.add('text-gray-400');
                        } else {
                            cellText = date;
                            date++;
                        }

                        cell.classList.add('pt-4');
                        let cellDiv = document.createElement('div');
                        cellDiv.classList.add('px-2', 'py-2', 'cursor-pointer', 'flex', 'w-full', 'justify-center');
                        cellDiv.textContent = cellText;
                        cellDiv.setAttribute('data-date', cellText.toString());
                        cell.appendChild(cellDiv);
                        row.appendChild(cell);
                    }
                    calendarBody.appendChild(row);
                }

                calendarBody.querySelectorAll('td').forEach(cell => {
                    cell.addEventListener('click', async function() {
                        const prevSelectedCell = calendarBody.querySelector('.bg-indigo-500');
                        if (prevSelectedCell) {
                            prevSelectedCell.classList.remove('bg-indigo-500', 'text-white',
                                'rounded-full');
                        }

                        this.classList.add('bg-indigo-500', 'text-white', 'rounded-full');
                        selectedDate = new Date(currentYear, currentMonth, parseInt(this
                            .querySelector('[data-date]').getAttribute('data-date')));
                        const formattedDate = formatDate(selectedDate);

                        clickedDateDisplay.textContent = `${formattedDate}`;

                        const reservations = await fetchReservations(selectedCardId,
                            formattedDate);
                        displayReservations(reservations);
                    });
                });
            }

            prevMonth.addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                currentYear = currentDate.getFullYear();
                currentMonth = currentDate.getMonth();
                renderCalendar();

                if (selectedDate) {
                    const lastDateOfMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
                    if (selectedDate.getDate() > lastDateOfMonth) {
                        selectedDate.setDate(lastDateOfMonth);
                    }

                    clickedDateDisplay.textContent = `${formatDate(selectedDate)}`;
                }
            });

            nextMonth.addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                currentYear = currentDate.getFullYear();
                currentMonth = currentDate.getMonth();
                renderCalendar();

                if (selectedDate) {
                    const lastDateOfMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
                    if (selectedDate.getDate() > lastDateOfMonth) {
                        selectedDate.setDate(lastDateOfMonth);
                    }

                    clickedDateDisplay.textContent = `${formatDate(selectedDate)}`;
                }
            });

            renderCalendar();
        });

        function showCards(tableId) {
            selectedDate = null;
            selectedCardId = null;
            displayReservations([]);
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => card.classList.remove('hidden'));
            document.getElementById(tableId).classList.add('hidden');
            calendarBody.querySelectorAll('td').forEach(cell => {
                cell.classList.remove('bg-indigo-500', 'text-white', 'rounded-full');
            });
        }

        async function fetchReservations(roomId, date) {
            return reservationsData[roomId] ? reservationsData[roomId][date] || [] : [];
        }

        function displayReservations(reservations) {
            const displayArea = document.getElementById('reservationsDisplay');
            displayArea.innerHTML = '';

            if (reservations.length === 0) {
                displayArea.innerHTML = '<p>No reservations for this date.</p>';
                return;
            }

            reservations.forEach(reservation => {
                const reservationDiv = document.createElement('div');
                reservationDiv.classList.add('border-b', 'py-4', 'border-gray-400', 'border-dashed');
                reservationDiv.innerHTML = `
                    <p class="text-xs font-light leading-3 text-gray-500 dark:text-gray-300">${reservation.start_time} - ${reservation.end_time}</p>
                    <p class="focus:outline-none text-lg font-medium leading-5 text-gray-800 dark:text-gray-100 mt-2">${reservation.full_name}</p>
                    <p class="text-sm pt-2 leading-4 text-gray-600 dark:text-gray-300">WhatsApp: ${reservation.whatsapp || 'N/A'}</p>
                    <p class="text-sm pt-2 leading-4 text-gray-600 dark:text-gray-300">Email: ${reservation.email || 'N/A'}</p>
                `;
                displayArea.appendChild(reservationDiv);
            });
        }
    </script>
</div>
