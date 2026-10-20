// Khởi tạo mảng đối tượng gồm 5 công việc mẫu[cite: 2]
let tasks = [
    { id: 1, name: "Hoàn thành bài tập Lập trình Web", dueDate: "2026-10-20", priority: "Cao", completed: false },
    { id: 2, name: "Ôn tập môn Cấu trúc dữ liệu", dueDate: "2026-10-22", priority: "Trung bình", completed: false },
    { id: 3, name: "Mua đồ dùng sinh hoạt cá nhân", dueDate: "2026-10-15", priority: "Thấp", completed: true },
    { id: 4, name: "Gặp giảng viên hướng dẫn đồ án", dueDate: "2026-10-25", priority: "Cao", completed: false },
    { id: 5, name: "Nộp báo cáo thực tập tốt nghiệp", dueDate: "2026-10-30", priority: "Trung bình", completed: false }
];

const taskForm = document.getElementById('task-form');
const taskNameInput = document.getElementById('task-name');
const taskDateInput = document.getElementById('task-date');
const taskPriorityInput = document.getElementById('task-priority');
const errorMsg = document.getElementById('error-msg');
const searchInput = document.getElementById('search-input');
const statusFilter = document.getElementById('status-filter');
const taskList = document.getElementById('task-list');

// Hàm định dạng chuỗi ngày từ YYYY-MM-DD sang DD/MM/YYYY để hiển thị đẹp mắt
function formatDate(dateString) {
    if (!dateString) return 'Không có';
    const parts = dateString.split('-');
    if (parts.length !== 3) return dateString;
    return `${parts[2]}/${parts[1]}/${parts[0]}`;
}

// Hàm hiển thị danh sách công việc ra giao diện[cite: 2]
function renderTasks(tasksToRender) {
    taskList.innerHTML = '';
    
    if (tasksToRender.length === 0) {
        taskList.innerHTML = '<li style="text-align: center; padding: 10px; color: #777; font-size: 13px;">Không có công việc nào phù hợp</li>';
        return;
    }

    tasksToRender.forEach(task => {
        const li = document.createElement('li');
        li.className = `task-item ${task.completed ? 'completed' : ''}`;
        
        li.innerHTML = `
            <div class="task-info">
                <h3>${escapeHtml(task.name)}</h3>
                <p>Hạn: ${formatDate(task.dueDate)} | Ưu tiên: <span class="priority-${task.priority}">${task.priority}</span></p>
            </div>
            <div class="task-actions">
                <button class="btn-toggle" onclick="toggleTask(${task.id})">${task.completed ? 'Hoàn tác' : 'Hoàn thành'}</button>
                <button class="btn-delete" onclick="deleteTask(${task.id})">Xóa</button>
            </div>
        `;
        taskList.appendChild(li);
    });
}

// Chống lỗi XSS cơ bản cho tên công việc
function escapeHtml(str) {
    return str.replace(/[&<>'"]/g, 
        tag => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' }[tag] || tag)
    );
}

// Xử lý thêm công việc từ form, kiểm tra không rỗng, cập nhật và xóa trống form ngay[cite: 2]
taskForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const name = taskNameInput.value.trim();
    const dueDate = taskDateInput.value;
    const priority = taskPriorityInput.value;

    if (name === '') {
        errorMsg.textContent = 'Tên công việc không được để trống!';
        taskNameInput.focus();
        return;
    } else {
        errorMsg.textContent = '';
    }

    const newTask = {
        id: Date.now(),
        name: name,
        dueDate: dueDate,
        priority: priority,
        completed: false
    };

    tasks.push(newTask);
    
    // Cập nhật giao diện ngay lập tức và reset form[cite: 2]
    taskForm.reset();
    filterAndRender();
});

// Hàm đánh dấu hoàn thành/chưa hoàn thành[cite: 2]
function toggleTask(id) {
    tasks = tasks.map(task => {
        if (task.id === id) {
            return { ...task, completed: !task.completed };
        }
        return task;
    });
    filterAndRender();
}

// Hàm xóa công việc đúng ID[cite: 2]
function deleteTask(id) {
    tasks = tasks.filter(task => task.id !== id);
    filterAndRender();
}

// Hàm tìm kiếm (không phân biệt hoa/thường) và lọc theo trạng thái[cite: 2]
function filterAndRender() {
    const keyword = searchInput.value.toLowerCase().trim();
    const status = statusFilter.value;

    let filtered = tasks.filter(task => {
        const matchName = task.name.toLowerCase().includes(keyword);
        let matchStatus = true;
        if (status === 'incomplete') {
            matchStatus = !task.completed;
        } else if (status === 'completed') {
            matchStatus = task.completed;
        }
        return matchName && matchStatus;
    });

    renderTasks(filtered);
}

// Lắng nghe sự kiện tìm kiếm và lọc
searchInput.addEventListener('input', filterAndRender);
statusFilter.addEventListener('change', filterAndRender);

// Hiển thị danh sách ban đầu khi tải trang
renderTasks(tasks);