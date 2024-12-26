<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities Management - TravelEase</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .ocean-gradient {
            background: linear-gradient(135deg, #034694 0%, #00a7b3 100%);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }
    </style>
</head>
<body class="bg-slate-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-72 ocean-gradient text-white py-8 px-6 fixed h-full">
            <div class="flex items-center mb-12">
                <i class="fas fa-compass text-3xl mr-3"></i>
                <span class="text-2xl font-bold tracking-wider">TravelEase</span>
            </div>
            
            <nav class="space-y-6">
                <a href="dashboord.php.php" class="flex items-center space-x-4 px-6 py-4 hover:bg-white hover:bg-opacity-10 rounded-xl">
                    <i class="fas fa-th-large text-lg"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="users.php" class="flex items-center space-x-4 px-6 py-4 hover:bg-white hover:bg-opacity-10 rounded-xl">
                    <i class="fas fa-users text-lg"></i>
                    <span class="font-medium">Clients</span>
                </a>
                <a href="reservations.php" class="flex items-center space-x-4 px-6 py-4 hover:bg-white hover:bg-opacity-10 rounded-xl">
                    <i class="fas fa-calendar-check text-lg"></i>
                    <span class="font-medium">Reservations</span>
                </a>
                <a href="activities.php" class="flex items-center space-x-4 px-6 py-4 bg-white bg-opacity-10 rounded-xl">
                    <i class="fas fa-hiking text-lg"></i>
                    <span class="font-medium">Activities</span>
                </a>
                <a href="#" class="flex items-center space-x-4 px-6 py-4 hover:bg-white hover:bg-opacity-10 rounded-xl">
                    <i class="fas fa-cog text-lg"></i>
                    <span class="font-medium">Settings</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-72 p-8">
            <!-- Top Navigation -->
            <div class="flex justify-between items-center mb-12 bg-white rounded-2xl p-6 shadow-sm">
                <div class="flex items-center">
                    <div class="relative">
                        <input type="text" placeholder="Search activities..." 
                               class="pl-12 pr-4 py-3 bg-slate-50 rounded-xl w-72 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                        <i class="fas fa-search absolute left-4 top-4 text-slate-400"></i>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <button class="relative p-2 bg-slate-50 rounded-xl hover:bg-slate-100 transition-all duration-300">
                            <i class="fas fa-bell text-slate-600 text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">3</span>
                        </button>
                    </div>
                    <!-- Admin Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center bg-slate-50 rounded-xl p-2 pr-4 hover:bg-slate-100 transition-all duration-300">
                            <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center text-white font-bold mr-3">
                                TA
                            </div>
                            <span class="font-medium text-slate-700">Admin</span>
                            <i class="fas fa-chevron-down ml-3 text-slate-400 transition-transform group-hover:rotate-180"></i>
                        </button>
                        
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-300 z-50">
                            <a href="#" class="block px-4 py-2 text-slate-700 hover:bg-slate-50">
                                <i class="fas fa-user mr-2"></i>Profile
                            </a>
                            <a href="#" class="block px-4 py-2 text-slate-700 hover:bg-slate-50">
                                <i class="fas fa-cog mr-2"></i>Settings
                            </a>
                            <hr class="my-2 border-slate-100">
                            <a href="#" class="block px-4 py-2 text-red-600 hover:bg-slate-50">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activities Table -->
            <div class="bg-white rounded-2xl shadow-sm">
                <div class="p-8 border-b border-slate-100">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-slate-800">Activities Management</h2>
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-all duration-300">
                            <i class="fas fa-plus mr-2"></i>Add New Activity
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto p-4">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left">
                                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Activity Title</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Type</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Price Type</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Price</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <tr class="hover:bg-slate-50 transition-all duration-300">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 font-medium mr-3">
                                            <i class="fas fa-mountain"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-800">Mountain Hiking Adventure</p>
                                            <p class="text-sm text-slate-500">Beginner Friendly</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="status-badge bg-emerald-100 text-emerald-700">Outdoor</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="status-badge bg-blue-100 text-blue-700">Per Person</span>
                                </td>
                                <td class="px-6 py-4 text-slate-800 font-medium">$49.99</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <a href="edit_activity.php?id=1" class="text-blue-500 hover:text-blue-700" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="text-red-500 hover:text-red-700" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-50 transition-all duration-300">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 font-medium mr-3">
                                            <i class="fas fa-water"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-800">Scuba Diving Experience</p>
                                            <p class="text-sm text-slate-500">PADI Certified</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="status-badge bg-blue-100 text-blue-700">Water</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="status-badge bg-violet-100 text-violet-700">Group Rate</span>
                                </td>
                                <td class="px-6 py-4 text-slate-800 font-medium">$199.99</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <a href="edit_activity.php?id=2" class="text-blue-500 hover:text-blue-700" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="text-red-500 hover:text-red-700" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="hover:bg-slate-50 transition-all duration-300">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600 font-medium mr-3">
                                            <i class="fas fa-map-marked-alt"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-800">City Walking Tour</p>
                                            <p class="text-sm text-slate-500">Historical Sites</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="status-badge bg-amber-100 text-amber-700">Cultural</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="status-badge bg-blue-100 text-blue-700">Per Person</span>
                                </td>
                                <td class="px-6 py-4 text-slate-800 font-medium">$29.99</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <a href="edit_activity.php?id=3" class="text-blue-500 hover:text-blue-700" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="text-red-500 hover:text-red-700" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>