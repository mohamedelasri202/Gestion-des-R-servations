<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelEase - Sign Up or Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Hide sections by default */
        #signup, #signin {
            display: none;
        }
        /* Show Sign Up by default */
        #signup:target {
            display: block;
        }
        /* Show Sign In when targeted */
        #signin:target {
            display: block;
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-sm max-w-md w-full">
        <!-- Navigation -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center mb-4">
                <i class="fas fa-compass text-3xl text-blue-600 mr-2"></i>
                <span class="text-2xl font-bold text-slate-800">TravelEase</span>
            </div>
            <div>
                <a href="#signup" class="text-blue-500 hover:text-blue-600 ml-1">Sign Up</a> |
                <a href="#signin" class="text-blue-500 hover:text-blue-600 ml-1">Sign In</a>
            </div>
        </div>

        <!-- Sign Up Form -->
        <div id="signup">
            <h2 class="text-2xl font-bold text-slate-800">Create Account</h2>
            <p class="text-slate-500 mt-2">Join TravelEase today</p>
            <form action="index.html" class="space-y-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
                    <input type="text" class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <button type="submit" class="w-full py-3 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-colors">
                    Sign Up
                </button>
            </form>
        </div>

        <!-- Sign In Form -->
        <div id="signin">
            <h2 class="text-2xl font-bold text-slate-800">Welcome Back</h2>
            <p class="text-slate-500 mt-2">Sign in to your account</p>
            <form action="index.html" class="space-y-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <button type="submit" class="w-full py-3 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-colors">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</body>
</html>
