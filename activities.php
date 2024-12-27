<?php
include 'Database.php';

class Activity {
    private $name;
    private $description;
    private $type;
    private $location;
    private $price;
    private $availability_status;
    private $image_url;
    protected $dbcon;

    public function __construct($db, $name = "", $description = "", $type = "", $location = "", $price = "", $availability_status = "", $image_url = "") {
        $this->dbcon = $db;
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->location = $location;
        $this->price = $price;
        $this->availability_status = $availability_status;
        $this->image_url = $image_url;
    }

    public function insertActivity() {
        try {
            $sql = "INSERT INTO Activities(name, description, type, location, price, availability_status, image_url)
                    VALUES (:name, :description, :type, :location, :price, :availability_status, :image_url)";
            $stmt = $this->dbcon->prepare($sql);

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':location', $this->location);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':availability_status', $this->availability_status);
            $stmt->bindParam(':image_url', $this->image_url);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getActivities() {
        try {
            $sql = "SELECT * FROM Activities";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }


    public function deleteActivity($id) {
        try {
            $sql = "DELETE FROM Activities WHERE id = :id";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public function updateActivity($id, $name, $description, $type, $location, $price, $status) {
        try {
            $sql = "UPDATE Activities SET name=:name, description=:description, type=:type, 
                    location=:location, price=:price, availability_status=:status 
                    WHERE id=:id";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':name' => $name,
                ':description' => $description,
                ':type' => $type,
                ':location' => $location,
                ':price' => $price,
                ':status' => $status
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    

}

$db = new Database();
$conn = $db->connect();
    // Handle delete
    if(isset($_POST['delete_id'])) {
        $activity = new activity($conn);
        if($activity->deleteActivity($_POST['delete_id'])) {
            echo "<script>alert('Activity deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error deleting activity!');</script>";
        }
    }
if (!$conn) {
    die("Database connection failed. Please try again later.");
}

// Insert Activity Logic
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $availability_status = $_POST['availability_status'];

    // File upload handling
    $image_url = "";
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $target_dir = "uploads/";
        $file_type = pathinfo($_FILES["image_url"]["name"], PATHINFO_EXTENSION);
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($file_type, $allowed_types)) {
            $target_file = $target_dir . uniqid() . "." . $file_type;
            move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file);
            $image_url = $target_file;
        } else {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.');</script>";
            exit;
        }
    }

    // Validation
    if (empty($name) || empty($type) || empty($price)) {
        echo "<script>alert('Name, type, and price are required!');</script>";
    } else {
        $activity = new Activity($conn, $name, $description, $type, $location, $price, $availability_status, $image_url);
        $result = $activity->insertActivity();

        if ($result === true) {
            echo "<script>alert('Activity added successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . addslashes($result) . "');</script>";
        }
    }
}

// Delete Activity Logic
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    if (!is_numeric($id)) {
        echo "<script>alert('Invalid ID.');</script>";
        exit;
    }

    $activity = new Activity($conn);
    $result = $activity->deleteActivity($id);

    if ($result === true) {
        echo "<script>alert('Activity deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . addslashes($result) . "');</script>";
    }
    // Handle edit
// Handle edit form submission

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Activities WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $activity = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($activity) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                populateEditModal(" . json_encode($activity) . ");
            });
        </script>";
    }
}




}
?>


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
    <!-- Activity Form Modal -->
    <div id="activityModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 w-[30vw] max-w-5xl max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 id="modalTitle" class="text-xl font-bold text-slate-800">Add New Activity</h3>
            <button onclick="toggleModal()" class="text-slate-400 hover:text-slate-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form class="space-y-4" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="activity_id" id="activity_id">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Photo</label>
                <input type="file" name="image_url" class="w-full p-2 border border-slate-200 rounded-xl">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
                <input type="text" name="name" required 
                       class="w-full p-2 border border-slate-200 rounded-xl" 
                       placeholder="Activity name">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                <textarea name="description" 
                          class="w-full p-2 border border-slate-200 rounded-xl h-20" 
                          placeholder="Activity description"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Type</label>
                <select name="type" required class="w-full p-2 border border-slate-200 rounded-xl">
                    <option value="flight">Flight</option>
                    <option value="hotel">Hotel</option>
                    <option value="tour">Tour</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Location</label>
                <input type="text" name="location" 
                       class="w-full p-2 border border-slate-200 rounded-xl" 
                       placeholder="Activity location">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Price</label>
                <input type="number" name="price" required step="0.01" 
                       class="w-full p-2 border border-slate-200 rounded-xl" 
                       placeholder="0.00">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Availability Status</label>
                <select name="availability_status" required class="w-full p-2 border border-slate-200 rounded-xl">
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>
            <div class="flex justify-end space-x-4 mt-4">
                <button type="button" onclick="toggleModal()" 
                        class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl hover:bg-slate-200">
                    Cancel
                </button>
                <button type="submit" name="submit" id="submitBtn" 
                        class="px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600">
                    Add Activity
                </button>
            </div>
        </form>
    </div>
</div>

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-72 ocean-gradient text-white py-8 px-6 fixed h-full">
            <div class="flex items-center mb-12">
                <i class="fas fa-compass text-3xl mr-3"></i>
                <span class="text-2xl font-bold tracking-wider">TravelEase</span>
            </div>
            
            <nav class="space-y-6">
                <a href="dashboard.php" class="flex items-center space-x-4 px-6 py-4 hover:bg-white hover:bg-opacity-10 rounded-xl">
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
                        <button onclick="toggleModal()" class="px-4 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-all duration-300">
                            <i class="fas fa-plus mr-2"></i>Add New Activity
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto p-4">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left">
                                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Activity Name</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Type</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Location</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Description</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Price</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Status</th>
                                <th class="px-6 py-4 text-sm font-semibold text-slate-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
<?php
$activity = new Activity($conn);
$activities = $activity->getActivities();

foreach ($activities as $row) {
    ?>
    <tr class="hover:bg-slate-50 transition-all duration-300">
        <td class="px-6 py-4">
            <div class="flex items-center">
                <img src="<?php echo $row['image_url']; ?>" 
                     class="w-16 h-16 rounded-lg object-cover mr-3">
                <p class="font-medium text-slate-800"><?php echo $row['name']; ?></p>
            </div>
        </td>
        <td class="px-6 py-4">
            <span class="status-badge bg-blue-100 text-blue-700"><?php echo $row['type']; ?></span>
        </td>
        <td class="px-6 py-4 text-slate-600"><?php echo $row['location']; ?></td>
        <td class="px-6 py-4 text-slate-600"><?php echo $row['description']; ?></td>
        <td class="px-6 py-4 text-slate-800 font-medium">$<?php echo $row['price']; ?></td>
        <td class="px-6 py-4">
            <span class="status-badge bg-emerald-100 text-emerald-700"><?php echo $row['availability_status']; ?></span>
        </td>
        <td class="px-6 py-4">
            <div class="flex space-x-3">
                <a href="activities.php?id=<?php echo $row['id']; ?>" class="px-3 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                    Edit
                </a>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="delete" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Delete
                    </button>
                </form>
            </div>
        </td>
    </tr>
    <?php
}
?>
</tbody>


                    </table>
                </div>
            </div>
        </main>
    </div>

 
  
    <script>
      function toggleModal() {
    const modal = document.getElementById('activityModal');
    modal.classList.toggle('flex');
    modal.classList.toggle('hidden');
}

function populateEditModal(activity) {
    document.getElementById('modalTitle').textContent = 'Edit Activity';
    document.getElementById('activity_id').value = activity.id;
    document.querySelector('[name="name"]').value = activity.name;
    document.querySelector('[name="description"]').value = activity.description;
    document.querySelector('[name="type"]').value = activity.type;
    document.querySelector('[name="location"]').value = activity.location;
    document.querySelector('[name="price"]').value = activity.price;
    document.querySelector('[name="availability_status"]').value = activity.availability_status;
    document.getElementById('submitBtn').textContent = 'Update Activity';
    
    toggleModal();
}

document.querySelector('#activityModal button[onclick="toggleModal()"]').addEventListener('click', function() {
    setTimeout(() => {
        document.getElementById('modalTitle').textContent = 'Add New Activity';
        document.getElementById('activity_id').value = '';
        document.querySelector('[name="name"]').value = '';
        document.querySelector('[name="description"]').value = '';
        document.querySelector('[name="type"]').value = '';
        document.querySelector('[name="location"]').value = '';
        document.querySelector('[name="price"]').value = '';
        document.querySelector('[name="availability_status"]').value = '';
        document.getElementById('submitBtn').textContent = 'Add Activity';
    }, 300);
});

    
    </script>




  



</body>
</html>