<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <meta name="author" content="">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        .bg-sidebar {
            background: #3d68ff;
        }

        .cta-btn {
            color: #3d68ff;
        }

        .upgrade-btn {
            background: #1947ee;
        }

        .upgrade-btn:hover {
            background: #0038fd;
        }

        .active-nav-link {
            background: #1947ee;
        }

        .nav-item:hover {
            background: #1947ee;
        }

        .account-link:hover {
            background: #3d68ff;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
            <a href="javascript:void(0);">
                <button onclick="openAddModal()"
                    class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-plus mr-3"></i> Laporan Baru
                </button>
            </a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="/" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('form_data') }}"
                class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-align-left mr-3"></i>
                Laporan Form
            </a>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen"
                    class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">
                </button>
                <button x-show="isOpen" @click="isOpen = false"
                    class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Account</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Support</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>
            <button
                class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> Laporan Baru
            </button>
        </header>

        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Dashboard</h1>

                <div class="w-full mt-12">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Latest Reports
                    </p>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Id</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Judul</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Laporan</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">No seri</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Status</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">ACTION</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700" id="table-body">
                                <!-- Existing data rendering with Blade's foreach loop -->
                                @foreach ($data_laporan as $data)
                                    <tr>
                                        <td class="w-1/9 text-left py-3 px-4">{{ $data->id }}</td>
                                        <td class="w-1/7 text-left py-3 px-4">{{ $data->judul }}</td>
                                        <td class="w-1/3 text-left py-3 px-4">{{ $data->laporan }}</td>
                                        <td class="w-1/8 text-left py-3 px-4">{{ $data->no_seri }}</td>
                                        <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                                                href="tel:622322662">{{ $data->status }}</a></td>
                                        <td class="text-left py-3 px-4">
                                            <button type="button"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none"
                                                onclick="openModal({{ $data->id }})">Details</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            {{-- Modal Content --}}
                            @foreach ($data_laporan as $data)
                                <div id="myModal-{{ $data->id }}" class="modal modalis">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeModal({{ $data->id }})">&times;</span>
                                        <p class="flex justify-center uppercase font-bold">{{ $data->judul }}</p>
                                        <p>{{ $data->id }}</p>
                                        <p class="pt-4">NO SERI: {{ $data->no_seri }}</p>
                                        <p>STATUS: {{ $data->status }}</p>
                                        <p class="pb-4">Laporan: {{ $data->laporan }}</p>
                                        <div class="flex justify-end">
                                            <a href="javascript:void(0);" onclick="openEditModal({{ $data->id }})">
                                                <button type="button"
                                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">EDIT</button>
                                            </a>
                                            <a href="javascript:void(0);">
                                                <button type="button" onclick="openDeleteModal({{ $data->id }})"
                                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">DELETE</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="editModal-{{ $data->id }}" class="modal">
                                    <div class="modal-content">
                                        <span class="close absolute top-2 right-4 text-gray-600 cursor-pointer"
                                            onclick="closeEditModal()">
                                            &times;
                                        </span>
                                        <form id="editForm-{{ $data->id }}"
                                            action="{{ route('update_data', ['id' => $data->id]) }}" method="POST"
                                            class="p-6">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $data->id }}"
                                                id="editId">
                                            <div class="mb-4">
                                                <label for="editJudul"
                                                    class="block text-sm font-medium text-gray-700">Judul</label>
                                                <input type="text" name="judul" id="editJudul"
                                                    class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-300"
                                                    required value="{{ $data->judul }}">
                                            </div>
                                            <div class="mb-4">
                                                <label for="editLaporan"
                                                    class="block text-sm font-medium text-gray-700">Laporan</label>
                                                <textarea name="laporan" id="editLaporan"
                                                    class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-300"
                                                    rows="4" required>{{ $data->laporan }}</textarea>
                                            </div>
                                            <div class="mb-4">
                                                <label for="editSeri"
                                                    class="block text-sm font-medium text-gray-700">NO SERI</label>
                                                <input type="text" name="no_seri" id="editSeri"
                                                    class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-300"
                                                    required value="{{ $data->no_seri }}">
                                            </div>
                                            <div class="mb-4">
                                                <label for="editStatus"
                                                    class="block text-sm font-medium text-gray-700">Status</label>
                                                <select name="status" id="editStatus"
                                                    class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-300">
                                                    <option id="value-first">{{ $data->status }}</option>
                                                    <option value="DIBATALKAN">DIBATALKAN</option>
                                                    <option value="DILANJUTKAN">DILANJUTKAN</option>
                                                    <option value="SELESAI">SELESAI</option>
                                                </select>
                                            </div>
                                            <!-- Add other input fields as needed -->
                                            <div class="mt-4 flex justify-end">
                                                <button type="button" onclick="closeEditModal()"
                                                    class="btn-save bg-red-500 text-white px-4 py-2 mr-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2">Close</button>
                                                <button type="button" onclick="saveChanges({{ $data->id }})"
                                                    class="btn-save bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2">Save
                                                    Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach



                            {{-- tambah data --}}
                            <div id="add-modal" class="modal">
                                <div class="modal-content">
                                    <span class="close absolute top-2 right-4 text-gray-600 cursor-pointer"
                                        onclick="closeEditModal()">
                                        &times;
                                    </span>
                                    <form id="add-form"
                                        action="{{ route('form_data_add') }}" method="POST"
                                        class="p-6">
                                        @csrf
                                        <input type="hidden" name="id" value=""
                                            id="editId">
                                        <div class="mb-4">
                                            <label for="editJudul"
                                                class="block text-sm font-medium text-gray-700">Judul</label>
                                            <input type="text" name="judul" id="editJudul"
                                                class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-300"
                                                required value="" placeholder="Title Ex:Barang Hancur">
                                        </div>
                                        <div class="mb-4">
                                            <label for="editLaporan"
                                                class="block text-sm font-medium text-gray-700">Laporan</label>
                                            <textarea name="laporan" id="editLaporan"
                                                class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-300"
                                                rows="4" placeholder="Isi yang mau di laporkan" required ></textarea>
                                        </div>
                                        <div class="mb-4">
                                            <label for="editSeri"
                                                class="block text-sm font-medium text-gray-700">NO SERI</label>
                                            <input type="text" name="no_seri" id="editSeri"
                                                class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-300"
                                                required value="" placeholder="Seri Ex:B00384ACD">
                                        </div>
                                        <div class="mb-4">
                                            <label for="editStatus"
                                                class="block text-sm font-medium text-gray-700">Status</label>
                                            <select name="status" id="editStatus"
                                                class="mt-1 block w-full border rounded-md shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-300">
                                                <option id="value-first">PILIH STATUS</option>
                                                <option value="DIBATALKAN">DIBATALKAN</option>
                                                <option value="DILANJUTKAN">DILANJUTKAN</option>
                                                <option value="SELESAI">SELESAI</option>
                                            </select>
                                        </div>
                                        <!-- Add other input fields as needed -->
                                        <div class="mt-4 flex justify-end">
                                            <button type="button" onclick="closeAddModal()"
                                                class="btn-save bg-red-500 text-white px-4 py-2 mr-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2">Close</button>
                                            <button type="button" onclick="saveAdd()"
                                                class="btn-save bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            



                            {{-- modal delete --}}
                            @foreach ($data_laporan as $data)
                                <!-- Delete Confirmation Modal -->
                                <div id="deleteModal-{{ $data->id }}" class="modal modaldel">
                                    <div class="modal-content">
                                        <span class="close" onclick="closeDeleteModal()">&times;</span>
                                        <p class="flex justify-center">Apakah Anda yakin ingin menghapus data ini?</p>
                                        <button onclick="deleteConfirmed({{ $data->id }})">Delete</button>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Live Search Input -->
                            <input type="text" class="w-full" id="searchInput" placeholder="Search...">

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


                            <script>
                                function saveAdd() {
                                    var formData = new FormData(document.getElementById("add-form"));
                                    formData.append("_token", "{{ csrf_token() }}");
                                    var url = "{{ route('form_data_add')}}";

                                    $.ajax({
                                        url: url,
                                        type: 'POST',
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        success: function(response) {
                                            console.log('Success:');
                                            closeAddModal();
                                            $.get("{{ route('dashboard_index') }}", function(response) {
                                                var tableBody = $(response).find('#table-body');
                                                $('#table-body').html(tableBody.html());
                                            });
                                        },
                                        error: function(error) {
                                            console.error('Error:', error);
                                        }
                                    });
                                }


                                function openAddModal() {
                                    $("#add-modal").css("display", "block");
                                }

                                function closeAddModal() {
                                    $("#add-modal").css("display", "none");
                                }
                                // Live Data Updates
                                function fetchData() {
                                    $.get("{{ route('dashboard_index') }}", function(response) {
                                        var tableBody = $(response).find('#table-body');
                                        $('#table-body').html(tableBody.html());
                                    });
                                }


                                // ajax delete
                                var deleteId;

                                function openDeleteModal(id) {
                                    deleteId = id;
                                    var modal = document.getElementById("deleteModal-" + id);
                                    closeModal(id);
                                    modal.style.display = "block";
                                }

                                function closeDeleteModal() {
                                    $(".modaldel").css("display", "none");
                                }

                                function deleteConfirmed(id) {

                                    $.ajax({
                                        url: "{{ route('delete_data', ['id' => '__ID__']) }}".replace('__ID__', id),
                                        type: "GET",
                                        data: {
                                            _token: "{{ csrf_token() }}"
                                        },
                                        success: function(response) {
                                            var modal = document.getElementById("myModal-" + id);
                                            if (modal) {
                                                modal.remove();
                                            }
                                            console.log("Data deleted successfully");
                                            closeDeleteModal();

                                        },
                                        error: function(error) {
                                            console.error("Error deleting data:", error);
                                        }
                                    });
                                }

                                // ajax edit / upate
                                function saveChanges(id) {
                                    var formData = new FormData(document.getElementById("editForm-" + id));
                                    formData.append("_token", "{{ csrf_token() }}");
                                    var url = "{{ route('update_data', ['id' => '__ID__']) }}";
                                    url = url.replace('__ID__', id);

                                    $.ajax({
                                        url: url,
                                        type: 'POST',
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        success: function(response) {
                                            console.log('Success:', id);
                                            closeModal(id);
                                            closeEditModal(id);
                                            $.get("{{ route('dashboard_index') }}", function(response) {
                                                var tableBody = $(response).find('#table-body');
                                                $('#table-body').html(tableBody.html());
                                            });
                                        },
                                        error: function(error) {
                                            console.error('Error:', error);
                                        }
                                    });
                                }


                                function openEditModal(id) {
                                    // $("#editId").val(id);
                                    // $("#editJudul").val(judul);
                                    // $("#editLaporan").val(laporan);
                                    // $("#editSeri").val(no_seri);
                                    // $("value-first").val(status);
                                    // // Populate other fields as needed
                                    $("#editModal-" + id).css("display", "block");
                                    $(".modalis").css("display", "none");
                                }

                                function closeEditModal(id) {
                                    $(".modal").css("display", "none");
                                }
                                // Live Data Updates
                                function fetchData() {
                                    $.get("{{ route('dashboard_index') }}", function(response) {
                                        var tableBody = $(response).find('#table-body');
                                        $('#table-body').html(tableBody.html());
                                    });
                                }

                                setInterval(fetchData, 5000);

                                $('#searchInput').on('input', function() {
                                    var searchQuery = $(this).val().toLowerCase();
                                    $('#table-body tr').each(function() {
                                        var rowText = $(this).text().toLowerCase();
                                        if (rowText.indexOf(searchQuery) === -1) {
                                            $(this).hide();
                                        } else {
                                            $(this).show();
                                        }
                                    });
                                });

                                // Modal Functions
                                function openModal(id) {
                                    var modal = document.getElementById("myModal-" + id);
                                    if (modal) {
                                        modal.style.display = "block";
                                    } else {
                                        console.error("Modal element not found.");
                                    }
                                }


                                function closeModal(id) {
                                    var modal = document.getElementById("myModal-" + id);
                                    modal.style.display = "none";
                                }
                            </script>

                        </table>
                    </div>
                </div>
            </main>
        </div>

    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>

</html>
