// function table_pagination(tableId, bodyId) {
//     $('#nav').remove();
//     $(tableId).after('<div id="nav"></div>');
//     var rowsShown = 10;
//     var $studentRows = $(bodyId + ' tr:visible');
//     var rowsTotal = $studentRows.length;
//     var numPages = Math.ceil(rowsTotal / rowsShown);
//     var currentPage = 0;

//     function displayPageNumbers(startPage) {
//         $('#nav').empty();
//         var maxPageNumbers = Math.min(5, numPages);
//         var endPage = startPage + maxPageNumbers - 1;
//         for (i = startPage; i <= endPage; i++) {
//             var pageNum = i + 1;
//             $('#nav').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
//         }
//         $('#nav').prepend('<a href="#" class="prev">&lt;</a> '); // Previous arrow
//         $('#nav').append('<a href="#" class="next">&gt;</a> '); // Next arrow
//         $('#nav a').removeClass('active');
//         $('#nav a[rel="'+currentPage+'"]').addClass('active');
//     }

//     function showRows(startItem, endItem) {
//         $studentRows.css('opacity','0.0').hide().slice(startItem, endItem)
//             .css('display','table-row').animate({opacity:1}, 300);
//     }

//     displayPageNumbers(currentPage);
//     showRows(0, rowsShown);

//     $('#nav').on('click', 'a', function(e){
//         e.preventDefault();
//         if ($(this).hasClass('prev')) { // Previous arrow clicked
//             if (currentPage > 0) {
//                 currentPage--;
//             }
//         } else if ($(this).hasClass('next')) { // Next arrow clicked
//             if (currentPage < numPages - 1) {
//                 currentPage++;
//             }
//         } else {
//             currentPage = parseInt($(this).attr('rel'));
//         }
//         var startItem = currentPage * rowsShown;
//         var endItem = Math.min(startItem + rowsShown, rowsTotal);
//         showRows(startItem, endItem);
//         var startPage = Math.max(0, currentPage - 2); // Adjust startPage to show 5 page numbers
//         displayPageNumbers(startPage);
//     });
// }

//----------times
const date = new Date();

const year = date.getFullYear();
const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
const day = String(date.getDate()).padStart(2, '0');

const hours = String(date.getHours()).padStart(2, '0');
const minutes = String(date.getMinutes()).padStart(2, '0');
const seconds = String(date.getSeconds()).padStart(2, '0');

const formattedDate = `${year}-${month}-${day}`;
const formattedTime = `${hours}:${minutes}:${seconds}`;
//----------times

function paginateTable(tableId, itemsPerPage) {
    let currentPage = 1;
    const table = document.getElementById(tableId);
    
    function renderTable(filteredRows) {
        for (let i = 0; i < filteredRows.length; i++) {
            filteredRows[i].style.display = 'none';
        }

        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        for (let i = start; i < end && i < filteredRows.length; i++) {
            filteredRows[i].style.display = 'table-row';
        }

        renderPagination(filteredRows);
    }

    function renderPagination(filteredRows) {
        const pagination = document.getElementById('nav');
        pagination.innerHTML = '';
        const totalPages = Math.ceil(filteredRows.length / itemsPerPage);

        // Add "First" arrow
        if (currentPage > 1) {
            const firstLink = document.createElement('span');
            firstLink.className = 'first';
            firstLink.innerText = '«';
            firstLink.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage = 1;
                    renderTable(filteredRows);
                }
            });
            pagination.appendChild(firstLink);
        }

        // Add "Previous" arrow
        if (currentPage > 1) {
            const prevLink = document.createElement('span');
            prevLink.className = 'prev';
            prevLink.innerText = '❮';
            prevLink.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    renderTable(filteredRows);
                }
            });
            pagination.appendChild(prevLink);
        }

        // Calculate the range of page numbers to display
        const maxPageNumbers = 5;
        const startPage = Math.max(1, currentPage - Math.floor(maxPageNumbers / 2));
        const endPage = Math.min(totalPages, startPage + maxPageNumbers - 1);

        // Add page numbers
        for (let i = startPage; i <= endPage; i++) {
            const pageLink = document.createElement('span');
            pageLink.className = 'page-link';
            pageLink.innerText = i;

            if (i === currentPage) {
                pageLink.classList.add('active');
            }

            pageLink.addEventListener('click', function() {
                currentPage = i;
                renderTable(filteredRows);
            });

            pagination.appendChild(pageLink);
        }

        // Add "Next" arrow
        if (currentPage < totalPages) {
            const nextLink = document.createElement('span');
            nextLink.className = 'next';
            nextLink.innerText = '❯';
            nextLink.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable(filteredRows);
                }
            });
            pagination.appendChild(nextLink);
        }

        // Add "Last" arrow
        if (currentPage < totalPages) {
            const lastLink = document.createElement('span');
            lastLink.className = 'last';
            lastLink.innerText = '»';
            lastLink.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage = totalPages;
                    renderTable(filteredRows);
                }
            });
            pagination.appendChild(lastLink);
        }
    }

    // Initial rendering with all rows
    renderTable(Array.from(table.getElementsByTagName('tbody')[0].getElementsByTagName('tr')));
}

function setup_Table_Search(searchInputId, tableId) {
    $(`#${searchInputId}`).on("keyup", debounce(function() {
        $('#loadprocessing').removeClass('d-none'); // Show loading indicator
        var value = $(this).val().toLowerCase();

        const rows = $(`#${tableId} tbody tr`);
        const filteredRows = [];

        rows.each(function() {
            if ($(this).text().toLowerCase().indexOf(value) > -1) {
                $(this).show();
                filteredRows.push(this);
            } else {
                $(this).hide();
            }
        });

        paginateTableWithFilteredRows(filteredRows, 10);

        $('#loadprocessing').addClass('d-none'); // Hide loading indicator after processing
    }, 100)); // Adjust the delay as needed
}

function paginateTableWithFilteredRows(filteredRows, itemsPerPage) {
    let currentPage = 1;

    function renderTable() {
        for (let i = 0; i < filteredRows.length; i++) {
            filteredRows[i].style.display = 'none';
        }

        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        for (let i = start; i < end && i < filteredRows.length; i++) {
            filteredRows[i].style.display = 'table-row';
        }

        renderPagination();
    }

    function renderPagination() {
        const pagination = document.getElementById('nav');
        pagination.innerHTML = '';
        const totalPages = Math.ceil(filteredRows.length / itemsPerPage);

        // Add "First" arrow
        if (currentPage > 1) {
            const firstLink = document.createElement('span');
            firstLink.className = 'first';
            firstLink.innerText = '«';
            firstLink.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage = 1;
                    renderTable();
                }
            });
            pagination.appendChild(firstLink);
        }

        // Add "Previous" arrow
        if (currentPage > 1) {
            const prevLink = document.createElement('span');
            prevLink.className = 'prev';
            prevLink.innerText = '❮';
            prevLink.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    renderTable();
                }
            });
            pagination.appendChild(prevLink);
        }

        // Calculate the range of page numbers to display
        const maxPageNumbers = 5;
        const startPage = Math.max(1, currentPage - Math.floor(maxPageNumbers / 2));
        const endPage = Math.min(totalPages, startPage + maxPageNumbers - 1);

        // Add page numbers
        for (let i = startPage; i <= endPage; i++) {
            const pageLink = document.createElement('span');
            pageLink.className = 'page-link';
            pageLink.innerText = i;

            if (i === currentPage) {
                pageLink.classList.add('active');
            }

            pageLink.addEventListener('click', function() {
                currentPage = i;
                renderTable();
            });

            pagination.appendChild(pageLink);
        }

        // Add "Next" arrow
        if (currentPage < totalPages) {
            const nextLink = document.createElement('span');
            nextLink.className = 'next';
            nextLink.innerText = '❯';
            nextLink.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable();
                }
            });
            pagination.appendChild(nextLink);
        }

        // Add "Last" arrow
        if (currentPage < totalPages) {
            const lastLink = document.createElement('span');
            lastLink.className = 'last';
            lastLink.innerText = '»';
            lastLink.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage = totalPages;
                    renderTable();
                }
            });
            pagination.appendChild(lastLink);
        }
    }

    renderTable();
}

function debounce(func, delay) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}

function loadOptions(selectId, tableName, valueColumn, displayColumn, condition = '') {
    $.ajax({
        method: 'POST',
        url: 'ajax/options.php',
        data: {
            'load_options': true,
            table: tableName,
            value_col: valueColumn,
            display_col: displayColumn,
            condition: condition // Pass condition as a string
        },
        dataType: 'json',
        success: function(data) {
            var selectElement = $('#' + selectId);
            selectElement.empty(); // Clear existing options
            if (data.error) {
                console.error(data.error);
                return;
            }
            data.forEach(function(item) {
                var option = $('<option></option>')
                    .attr('value', item[valueColumn])
                    .text(item[displayColumn]);
                selectElement.append(option);
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching options:', textStatus, errorThrown);
            console.error('Server response:', jqXHR.responseText); // Log the full response
        }
    });
}