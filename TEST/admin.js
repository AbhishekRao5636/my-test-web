// Firebase configuration - Replace with your actual config
const firebaseConfig = {
      apiKey: "AIzaSyBTUiXNbxbM6v2E4Pw2PJkrWOCF87Nj4qA",
  authDomain: "bn-last-king-by-bn.firebaseapp.com",
  databaseURL: "https://bn-last-king-by-bn-default-rtdb.firebaseio.com",
  projectId: "bn-last-king-by-bn",
  storageBucket: "bn-last-king-by-bn.appspot.com",
  messagingSenderId: "407054165426",
  appId: "1:407054165426:web:93caaf48ef763f364ef0ab"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const auth = firebase.auth();
const database = firebase.database();

// DOM Elements
const dashboardContent = document.getElementById('dashboardContent');
const usersContent = document.getElementById('usersContent');
const keysContent = document.getElementById('keysContent');
const settingsContent = document.getElementById('settingsContent');

const dashboardTab = document.getElementById('dashboardTab');
const usersTab = document.getElementById('usersTab');
const keysTab = document.getElementById('keysTab');
const settingsTab = document.getElementById('settingsTab');
const logoutBtn = document.getElementById('logoutBtn');

const totalUsersEl = document.getElementById('totalUsers');
const activeTodayEl = document.getElementById('activeToday');
const vipUsersEl = document.getElementById('vipUsers');
const bannedUsersEl = document.getElementById('bannedUsers');
const recentActivityEl = document.getElementById('recentActivity');
const usersTableEl = document.getElementById('usersTable');
const keysTableEl = document.getElementById('keysTable');

const addUserBtn = document.getElementById('addUserBtn');
const generateKeyBtn = document.getElementById('generateKeyBtn');
const bulkGenerateBtn = document.getElementById('bulkGenerateBtn');

const addUserModal = new bootstrap.Modal(document.getElementById('addUserModal'));
const generateKeyModal = new bootstrap.Modal(document.getElementById('generateKeyModal'));
const bulkGenerateModal = new bootstrap.Modal(document.getElementById('bulkGenerateModal'));

const saveUserBtn = document.getElementById('saveUserBtn');
const generateKeySubmitBtn = document.getElementById('generateKeySubmitBtn');
const bulkGenerateSubmitBtn = document.getElementById('bulkGenerateSubmitBtn');

// Global variables
let currentUser = null;
let usersData = [];
let keysData = [];
let activityData = [];

// Initialize the admin panel
function initAdminPanel() {
    // Check auth state
    auth.onAuthStateChanged(user => {
        if (user) {
            currentUser = user;
            document.getElementById('adminEmail').textContent = user.email;
            loadData();
        }
    });

    // Setup tab navigation
    dashboardTab.addEventListener('click', () => showTab('dashboard'));
    usersTab.addEventListener('click', () => showTab('users'));
    keysTab.addEventListener('click', () => showTab('keys'));
    settingsTab.addEventListener('click', () => showTab('settings'));
    logoutBtn.addEventListener('click', logout);

    // Setup buttons
    addUserBtn.addEventListener('click', () => addUserModal.show());
    generateKeyBtn.addEventListener('click', () => generateKeyModal.show());
    bulkGenerateBtn.addEventListener('click', () => bulkGenerateModal.show());

    saveUserBtn.addEventListener('click', saveUser);
    generateKeySubmitBtn.addEventListener('click', generateKey);
    bulkGenerateSubmitBtn.addEventListener('click', bulkGenerateKeys);
}

// Show the selected tab
function showTab(tab) {
    dashboardContent.style.display = 'none';
    usersContent.style.display = 'none';
    keysContent.style.display = 'none';
    settingsContent.style.display = 'none';

    dashboardTab.classList.remove('active');
    usersTab.classList.remove('active');
    keysTab.classList.remove('active');
    settingsTab.classList.remove('active');

    switch(tab) {
        case 'dashboard':
            dashboardContent.style.display = 'block';
            dashboardTab.classList.add('active');
            document.getElementById('pageTitle').textContent = 'Dashboard';
            break;
        case 'users':
            usersContent.style.display = 'block';
            usersTab.classList.add('active');
            document.getElementById('pageTitle').textContent = 'User Management';
            break;
        case 'keys':
            keysContent.style.display = 'block';
            keysTab.classList.add('active');
            document.getElementById('pageTitle').textContent = 'License Key Management';
            break;
        case 'settings':
            settingsContent.style.display = 'block';
            settingsTab.classList.add('active');
            document.getElementById('pageTitle').textContent = 'Settings';
            break;
    }
}

// Load all data from Firebase
function loadData() {
    // Load users
    database.ref('users').on('value', snapshot => {
        usersData = [];
        snapshot.forEach(childSnapshot => {
            const user = childSnapshot.val();
            user.id = childSnapshot.key;
            usersData.push(user);
        });
        updateUsersUI();
        updateDashboardStats();
    });

    // Load license keys
    database.ref('license_keys').on('value', snapshot => {
        keysData = [];
        snapshot.forEach(childSnapshot => {
            const key = childSnapshot.val();
            key.id = childSnapshot.key;
            keysData.push(key);
        });
        updateKeysUI();
    });

    // Load recent activity
    database.ref('activity').limitToLast(10).on('value', snapshot => {
        activityData = [];
        snapshot.forEach(childSnapshot => {
            const activity = childSnapshot.val();
            activity.id = childSnapshot.key;
            activityData.push(activity);
        });
        updateActivityUI();
    });
}

// Update the users table UI
function updateUsersUI() {
    usersTableEl.innerHTML = '';
    usersData.forEach(user => {
        const row = document.createElement('tr');
        
        // Determine status badge
        let statusBadge = '';
        if (user.status === 'active') {
            statusBadge = '<span class="badge bg-success">Active</span>';
        } else if (user.status === 'inactive') {
            statusBadge = '<span class="badge bg-warning text-dark">Inactive</span>';
        } else if (user.status === 'banned') {
            statusBadge = '<span class="badge bg-danger">Banned</span>';
        }
        
        // Determine actions
        const actions = `
            <button class="btn btn-sm btn-outline-primary edit-user" data-id="${user.id}">Edit</button>
            <button class="btn btn-sm btn-outline-danger delete-user" data-id="${user.id}">Delete</button>
        `;
        
        row.innerHTML = `
            <td>${user.uid || 'N/A'}</td>
            <td>${user.device_id || 'N/A'}</td>
            <td>${user.license_key || 'N/A'}</td>
            <td>${user.expiry_date || 'N/A'}</td>
            <td>${statusBadge}</td>
            <td>${actions}</td>
        `;
        
        usersTableEl.appendChild(row);
    });

    // Add event listeners to action buttons
    document.querySelectorAll('.edit-user').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const userId = e.target.getAttribute('data-id');
            editUser(userId);
        });
    });

    document.querySelectorAll('.delete-user').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const userId = e.target.getAttribute('data-id');
            deleteUser(userId);
        });
    });
}

// Update the license keys table UI
function updateKeysUI() {
    keysTableEl.innerHTML = '';
    keysData.forEach(key => {
        const row = document.createElement('tr');
        
        // Determine status badge
        let statusBadge = '';
        if (key.status === 'active') {
            statusBadge = '<span class="badge bg-success">Active</span>';
        } else if (key.status === 'inactive') {
            statusBadge = '<span class="badge bg-warning text-dark">Inactive</span>';
        } else if (key.status === 'used') {
            statusBadge = '<span class="badge bg-info text-dark">Used</span>';
        }
        
        // Determine actions
        const actions = `
            <button class="btn btn-sm btn-outline-primary edit-key" data-id="${key.id}">Edit</button>
            <button class="btn btn-sm btn-outline-danger delete-key" data-id="${key.id}">Delete</button>
        `;
        
        row.innerHTML = `
            <td>${key.key || 'N/A'}</td>
            <td>${key.type || 'N/A'}</td>
            <td>${key.created_at || 'N/A'}</td>
            <td>${key.expiry_date || 'N/A'}</td>
            <td>${statusBadge}</td>
            <td>${actions}</td>
        `;
        
        keysTableEl.appendChild(row);
    });

    // Add event listeners to action buttons
    document.querySelectorAll('.edit-key').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const keyId = e.target.getAttribute('data-id');
            editKey(keyId);
        });
    });

    document.querySelectorAll('.delete-key').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const keyId = e.target.getAttribute('data-id');
            deleteKey(keyId);
        });
    });
}

// Update the recent activity UI
function updateActivityUI() {
    recentActivityEl.innerHTML = '';
    activityData.forEach(activity => {
        const row = document.createElement('tr');
        
        // Format timestamp
        const timestamp = new Date(activity.timestamp);
        const formattedTime = timestamp.toLocaleString();
        
        // Determine status badge
        let statusBadge = '';
        if (activity.status === 'success') {
            statusBadge = '<span class="badge bg-success">Success</span>';
        } else if (activity.status === 'failed') {
            statusBadge = '<span class="badge bg-danger">Failed</span>';
        }
        
        row.innerHTML = `
            <td>${activity.device_id || 'N/A'}</td>
            <td>${activity.action || 'N/A'}</td>
            <td>${formattedTime}</td>
            <td>${statusBadge}</td>
        `;
        
        recentActivityEl.appendChild(row);
    });
}

// Update dashboard statistics
function updateDashboardStats() {
    totalUsersEl.textContent = usersData.length;
    
    // Calculate active today (users who logged in today)
    const today = new Date().toISOString().split('T')[0];
    const activeToday = usersData.filter(user => {
        return user.last_login && user.last_login.includes(today);
    }).length;
    activeTodayEl.textContent = activeToday;
    
    // Calculate VIP users
    const vipUsers = usersData.filter(user => {
        return user.license_key && user.license_key.includes('VIP-');
    }).length;
    vipUsersEl.textContent = vipUsers;
    
    // Calculate banned users
    const bannedUsers = usersData.filter(user => {
        return user.status === 'banned';
    }).length;
    bannedUsersEl.textContent = bannedUsers;
}

// Save a new user
function saveUser() {
    const deviceId = document.getElementById('deviceId').value;
    const licenseKey = document.getElementById('licenseKey').value || generateLicenseKey('FXM_TRADER');
    const expiryDate = document.getElementById('expiryDate').value;
    const status = document.getElementById('userStatus').value;
    
    const newUser = {
        device_id: deviceId,
        license_key: licenseKey,
        expiry_date: expiryDate,
        status: status,
        created_at: new Date().toISOString(),
        last_login: null
    };
    
    database.ref('users').push(newUser)
        .then(() => {
            alert('User added successfully!');
            addUserModal.hide();
            document.getElementById('addUserForm').reset();
            
            // Log activity
            logActivity('admin', `Added user with device ID: ${deviceId}`, 'success');
        })
        .catch(error => {
            alert('Error adding user: ' + error.message);
            logActivity('admin', `Failed to add user: ${error.message}`, 'failed');
        });
}

// Generate a new license key
function generateKey() {
    const keyType = document.getElementById('keyType').value;
    const expiryDate = document.getElementById('keyExpiry').value;
    const status = document.getElementById('keyStatus').value;
    
    const key = generateLicenseKey(keyType);
    
    const newKey = {
        key: key,
        type: keyType,
        expiry_date: expiryDate,
        status: status,
        created_at: new Date().toISOString(),
        used_by: null,
        used_at: null
    };
    
    database.ref('license_keys').push(newKey)
        .then(() => {
            alert('License key generated successfully!');
            generateKeyModal.hide();
            document.getElementById('generateKeyForm').reset();
            
            // Log activity
            logActivity('admin', `Generated ${keyType} license key`, 'success');
        })
        .catch(error => {
            alert('Error generating key: ' + error.message);
            logActivity('admin', `Failed to generate license key: ${error.message}`, 'failed');
        });
}

// Bulk generate license keys
function bulkGenerateKeys() {
    const keyType = document.getElementById('bulkKeyType').value;
    const keyCount = parseInt(document.getElementById('bulkKeyCount').value);
    const expiryDate = document.getElementById('bulkKeyExpiry').value;
    const status = document.getElementById('bulkKeyStatus').value;
    
    const keys = [];
    for (let i = 0; i < keyCount; i++) {
        const key = generateLicenseKey(keyType);
        keys.push({
            key: key,
            type: keyType,
            expiry_date: expiryDate,
            status: status,
            created_at: new Date().toISOString(),
            used_by: null,
            used_at: null
        });
    }
    
    // Save all keys to Firebase
    const updates = {};
    keys.forEach(key => {
        const newKeyRef = database.ref('license_keys').push();
        updates[newKeyRef.key] = key;
    });
    
    database.ref('license_keys').update(updates)
        .then(() => {
            alert(`Successfully generated ${keyCount} license keys!`);
            bulkGenerateModal.hide();
            document.getElementById('bulkGenerateForm').reset();
            
            // Log activity
            logActivity('admin', `Bulk generated ${keyCount} ${keyType} license keys`, 'success');
        })
        .catch(error => {
            alert('Error generating keys: ' + error.message);
            logActivity('admin', `Failed to bulk generate license keys: ${error.message}`, 'failed');
        });
}

// Generate a random license key
function generateLicenseKey(type) {
    const prefix = type === 'VIP' ? 'VIP-' : 
                   type === 'FXM_TRADER' ? 'FXM_TRADER-' : 
                   'TRIAL-';
    
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let key = prefix;
    
    for (let i = 0; i < 12; i++) {
        key += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    
    return key;
}

// Edit a user
function editUser(userId) {
    const user = usersData.find(u => u.id === userId);
    if (!user) return;
    
    // In a real implementation, you would show a modal with the user's data
    // and allow editing, then save the changes to Firebase
    alert(`Editing user with ID: ${userId}\n\nThis would open an edit modal in a real implementation.`);
}

// Delete a user
function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        database.ref('users/' + userId).remove()
            .then(() => {
                alert('User deleted successfully!');
                logActivity('admin', `Deleted user with ID: ${userId}`, 'success');
            })
            .catch(error => {
                alert('Error deleting user: ' + error.message);
                logActivity('admin', `Failed to delete user: ${error.message}`, 'failed');
            });
    }
}

// Edit a license key
function editKey(keyId) {
    const key = keysData.find(k => k.id === keyId);
    if (!key) return;
    
    // In a real implementation, you would show a modal with the key's data
    // and allow editing, then save the changes to Firebase
    alert(`Editing license key with ID: ${keyId}\n\nThis would open an edit modal in a real implementation.`);
}

// Delete a license key
function deleteKey(keyId) {
    if (confirm('Are you sure you want to delete this license key?')) {
        database.ref('license_keys/' + keyId).remove()
            .then(() => {
                alert('License key deleted successfully!');
                logActivity('admin', `Deleted license key with ID: ${keyId}`, 'success');
            })
            .catch(error => {
                alert('Error deleting license key: ' + error.message);
                logActivity('admin', `Failed to delete license key: ${error.message}`, 'failed');
            });
    }
}

// Log activity to Firebase
function logActivity(deviceId, action, status) {
    const activity = {
        device_id: deviceId,
        action: action,
        status: status,
        timestamp: new Date().toISOString()
    };
    
    database.ref('activity').push(activity);
}

// Logout the admin
function logout() {
    auth.signOut()
        .then(() => {
            window.location.href = 'login.html';
        })
        .catch(error => {
            alert('Error logging out: ' + error.message);
        });
}

// Initialize the admin panel when the page loads
window.addEventListener('DOMContentLoaded', initAdminPanel);