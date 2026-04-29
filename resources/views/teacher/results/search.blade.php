<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Results Search | Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2196f3;
            --secondary-color: #6ec6ff;
            --dark-color: #2c3e50;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --danger-color: #f44336;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            color: #333;
        }
        
        /* Header */
        .results-header {
            background: white;
            padding: 30px 0;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
        }
        
        /* Search Section */
        .search-section {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }
        
        .search-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 10px;
            padding: 25px;
            border: 2px dashed #dee2e6;
        }
        
        /* Student Info Card */
        .student-info-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-left: 5px solid var(--primary-color);
        }
        
        .student-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        /* Results Summary */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .summary-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: transform 0.3s ease;
        }
        
        .summary-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .summary-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .cgpa-display {
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-color);
            text-shadow: 0 2px 4px rgba(33, 150, 243, 0.2);
        }
        
        /* Semester Cards */
        .semester-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .semester-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.1);
        }
        
        .semester-card.active {
            border-color: var(--primary-color);
            background: #e3f2fd;
        }
        
        /* Result Table */
        .result-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .result-table th,
        .result-table td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            text-align: left;
        }
        
        .result-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: var(--dark-color);
            position: sticky;
            top: 0;
        }
        
        .result-table tr:hover {
            background: #f8f9fa;
        }
        
        .grade-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .grade-A { background: #d4edda; color: #155724; }
        .grade-B { background: #d1ecf1; color: #0c5460; }
        .grade-C { background: #fff3cd; color: #856404; }
        .grade-D { background: #f8d7da; color: #721c24; }
        .grade-F { background: #f5f5f5; color: #6c757d; }
        
        /* GPA Progress */
        .gpa-progress {
            height: 10px;
            background: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
            margin: 10px 0;
        }
        
        .gpa-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 5px;
        }
        
        /* Print Styles */
        @media print {
            .no-print {
                display: none !important;
            }
            
            body {
                background: white;
            }
            
            .student-info-card,
            .summary-card,
            .semester-card,
            .result-table {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }
            
            .summary-grid {
                grid-template-columns: 1fr;
            }
            
            .result-table {
                font-size: 0.9rem;
            }
            
            .result-table th,
            .result-table td {
                padding: 10px 8px;
            }
        }
        
        /* Loading Spinner */
        .loading-spinner {
            display: none;
            text-align: center;
            padding: 40px;
        }
        
        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid var(--primary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px auto;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #adb5bd;
        }
        
        /* Tooltip */
        .tooltip-inner {
            max-width: 300px;
            padding: 10px 15px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="results-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Student Results Management</h1>
                    <p class="text-muted mb-0">Search student by ID to view academic results and GPA</p>
                </div>
                <div class="no-print">
                    <a href="{{ route('teacher.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Search Section -->
        <div class="search-section no-print">
            <div class="search-card">
                <h4 class="mb-4"><i class="bi bi-search"></i> Search Student Results</h4>
                <form id="searchForm" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label class="form-label">Student ID</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                            <input type="text" 
                                   id="studentId" 
                                   name="student_id" 
                                   class="form-control" 
                                   placeholder="Enter student ID (e.g., 221-35-****)"
                                   required>
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i> Search
                            </button>
                        </div>
                        <div class="form-text">Enter the student's unique ID number</div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Or Search by Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" 
                                   id="studentName" 
                                   name="student_name" 
                                   class="form-control" 
                                   placeholder="Enter student name">
                            <button class="btn btn-outline-secondary" type="button" id="nameSearchBtn">
                                <i class="bi bi-search"></i> Search
                            </button>
                        </div>
                        <div class="form-text">Start typing to see suggestions</div>
                    </div>
                </form>
                
                <!-- Suggestions Dropdown -->
                <div id="suggestions" class="mt-3" style="display: none;">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Student Suggestions</h6>
                            <div id="suggestionsList" class="list-group list-group-flush">
                                <!-- Suggestions will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div class="loading-spinner" id="loadingSpinner">
            <div class="spinner"></div>
            <p>Loading student results...</p>
        </div>

        <!-- Student Info (Initially Hidden) -->
        <div id="studentInfoSection" style="display: none;">
            <!-- Student Information -->
            <div class="student-info-card">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        <img src="" alt="Student" class="student-avatar" id="studentAvatar">
                    </div>
                    <div class="col-md-8">
                        <h3 id="studentNameDisplay"></h3>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <p class="mb-1"><strong>Student ID:</strong> <span id="studentIdDisplay"></span></p>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-1"><strong>Department:</strong> <span id="studentDepartment"></span></p>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-1"><strong>Batch:</strong> <span id="studentBatch"></span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p class="mb-1"><strong>Program:</strong> <span id="studentProgram"></span></p>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-1"><strong>Email:</strong> <span id="studentEmail"></span></p>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-1"><strong>Phone:</strong> <span id="studentPhone"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-end no-print">
                        <button class="btn btn-outline-primary" onclick="window.print()">
                            <i class="bi bi-printer"></i> Print Results
                        </button>
                    </div>
                </div>
            </div>

            <!-- Overall Summary -->
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-number cgpa-display" id="overallCgpa">0.00</div>
                    <div class="stat-label">Overall CGPA</div>
                    <div class="gpa-progress">
                        <div class="gpa-progress-bar" id="cgpaProgress" style="width: 0%"></div>
                    </div>
                    <small class="text-muted">Out of 4.00</small>
                </div>
                
                <div class="summary-card">
                    <div class="summary-number" id="totalCredits">0</div>
                    <div class="stat-label">Total Credits Completed</div>
                </div>
                
                <div class="summary-card">
                    <div class="summary-number" id="totalCourses">0</div>
                    <div class="stat-label">Total Courses</div>
                </div>
                
                <div class="summary-card">
                    <div class="summary-number" id="totalSemesters">0</div>
                    <div class="stat-label">Semesters Completed</div>
                </div>
            </div>

            <!-- Semester-wise Results -->
            <h3 class="mb-4">Semester-wise Results</h3>
            <div id="semestersContainer">
                <!-- Semesters will be loaded here dynamically -->
            </div>

            <!-- Semester Details (Initially Hidden) -->
            <div id="semesterDetails" style="display: none;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 id="semesterTitle">Semester Details</h3>
                    <button class="btn btn-sm btn-outline-secondary no-print" onclick="hideSemesterDetails()">
                        <i class="bi bi-arrow-left"></i> Back to Semesters
                    </button>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Semester GPA</h5>
                                <div class="display-4 text-primary" id="semesterGpa">0.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Credits</h5>
                                <div class="display-4 text-success" id="semesterCredits">0</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Courses Taken</h5>
                                <div class="display-4 text-info" id="semesterCourses">0</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="result-table">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Credits</th>
                                <th>Marks</th>
                                <th>Grade</th>
                                <th>Grade Point</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="semesterCoursesTable">
                            <!-- Course details will be loaded here -->
                        </tbody>
                        <tfoot>
                            <tr class="table-light">
                                <td colspan="2"><strong>Semester Summary</strong></td>
                                <td><strong id="totalSemCredits">0</strong></td>
                                <td colspan="2"></td>
                                <td><strong id="totalGradePoints">0.00</strong></td>
                                <td><span class="badge bg-success" id="semesterStatus">Completed</span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="alert alert-info mt-4">
                    <i class="bi bi-info-circle"></i>
                    <strong>GPA Calculation:</strong> GPA = <span id="gpaCalculation">0.00 ÷ 0 = 0.00</span>
                    <div class="mt-2">
                        
                    </div>
                </div>
            </div>

            <!-- Complete Transcript -->
            <div class="mt-5 no-print">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Complete Academic Transcript</h3>
                    <button class="btn btn-outline-primary" id="toggleTranscript">
                        <i class="bi bi-chevron-down"></i> Show Full Transcript
                    </button>
                </div>
                
                <div id="fullTranscript" style="display: none;">
                    <div class="table-responsive">
                        <table class="result-table">
                            <thead>
                                <tr>
                                    <th>Semester</th>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Credits</th>
                                    <th>Marks</th>
                                    <th>Grade</th>
                                    <th>Grade Point</th>
                                    <th>GPA</th>
                                </tr>
                            </thead>
                            <tbody id="transcriptTable">
                                <!-- Full transcript will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div id="emptyState" class="empty-state">
            <i class="bi bi-person-lines-fill"></i>
            <h4>No Student Selected</h4>
            <p>Search for a student by ID or name to view their academic results.</p>
            <div class="mt-3">
                <button class="btn btn-primary" onclick="showSampleData()">
                    <i class="bi bi-eye"></i> View Sample Results
                </button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Global variables
        let currentStudentId = null;
        let studentData = null;
        
        // Search form submission
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const studentId = document.getElementById('studentId').value.trim();
            if (studentId) {
                searchStudent(studentId);
            }
        });
        
        // Name search button
        document.getElementById('nameSearchBtn').addEventListener('click', function() {
            const studentName = document.getElementById('studentName').value.trim();
            if (studentName) {
                searchStudentByName(studentName);
            }
        });
        
        // Name input for suggestions
        document.getElementById('studentName').addEventListener('input', function() {
            const query = this.value.trim();
            if (query.length >= 2) {
                fetchSuggestions(query);
            } else {
                hideSuggestions();
            }
        });
        
        // Search student by ID
        async function searchStudent(studentId) {
            showLoading();
            hideEmptyState();
            
            try {
                const response = await fetch(`/teacher/results/search/${studentId}`);
                const data = await response.json();
                
                if (data.success) {
                    displayStudentResults(data);
                } else {
                    alert(data.message || 'Student not found');
                    showEmptyState();
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error searching for student');
                showEmptyState();
            } finally {
                hideLoading();
            }
        }
        
        // Search student by name
        async function searchStudentByName(studentName) {
            showLoading();
            
            try {
                const response = await fetch(`/teacher/results/search-by-name/${encodeURIComponent(studentName)}`);
                const data = await response.json();
                
                if (data.success && data.students.length > 0) {
                    if (data.students.length === 1) {
                        // If only one student found, show results directly
                        searchStudent(data.students[0].id);
                    } else {
                        // Show selection options
                        showStudentOptions(data.students);
                    }
                } else {
                    alert('No students found with that name');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error searching for student');
            } finally {
                hideLoading();
            }
        }
        
        // Fetch suggestions
        async function fetchSuggestions(query) {
            try {
                const response = await fetch(`/teacher/results/suggestions/${encodeURIComponent(query)}`);
                const data = await response.json();
                
                if (data.success && data.suggestions.length > 0) {
                    showSuggestions(data.suggestions);
                }
            } catch (error) {
                console.error('Error fetching suggestions:', error);
            }
        }
        
        // Display student results
        function displayStudentResults(data) {
            studentData = data;
            currentStudentId = data.student.id;
            
            // Update student info
            document.getElementById('studentNameDisplay').textContent = data.student.name;
            document.getElementById('studentIdDisplay').textContent = data.student.id;
            document.getElementById('studentDepartment').textContent = data.student.department || 'N/A';
            document.getElementById('studentBatch').textContent = data.student.batch || 'N/A';
            document.getElementById('studentProgram').textContent = data.student.program || 'N/A';
            document.getElementById('studentEmail').textContent = data.student.email || 'N/A';
            document.getElementById('studentPhone').textContent = data.student.phone || 'N/A';
            
            // Set avatar
            const avatar = document.getElementById('studentAvatar');
            avatar.src = data.student.avatar || '/images/default-avatar.png';
            
            // Update summary
            document.getElementById('overallCgpa').textContent = data.summary.cgpa.toFixed(2);
            document.getElementById('totalCredits').textContent = data.summary.total_credits;
            document.getElementById('totalCourses').textContent = data.summary.total_courses;
            document.getElementById('totalSemesters').textContent = data.summary.total_semesters;
            
            // Update CGPA progress bar
            const cgpaPercent = (data.summary.cgpa / 4.0) * 100;
            document.getElementById('cgpaProgress').style.width = cgpaPercent + '%';
            
            // Display semesters
            displaySemesters(data.semesters);
            
            // Show student info section
            document.getElementById('studentInfoSection').style.display = 'block';
            document.getElementById('emptyState').style.display = 'none';
            
            // Update search fields
            document.getElementById('studentId').value = data.student.id;
            document.getElementById('studentName').value = data.student.name;
        }
        
        // Display semesters
        function displaySemesters(semesters) {
            const container = document.getElementById('semestersContainer');
            container.innerHTML = '';
            
            if (semesters.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="bi bi-journal"></i>
                        <h4>No Semester Results Found</h4>
                        <p>The student has not completed any semesters yet.</p>
                    </div>
                `;
                return;
            }
            
            semesters.forEach((semester, index) => {
                const card = document.createElement('div');
                card.className = 'semester-card';
                if (index === 0) card.classList.add('active');
                card.dataset.semesterIndex = index;
                card.onclick = () => showSemesterDetails(index);
                
                // Calculate GPA percentage for progress bar
                const gpaPercent = (semester.gpa / 4.0) * 100;
                
                card.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-2">${semester.name}</h4>
                            <div class="mb-2">
                                <span class="badge bg-primary">${semester.year}</span>
                                <span class="badge bg-secondary ms-2">${semester.credits} Credits</span>
                                <span class="badge bg-info ms-2">${semester.courses.length} Courses</span>
                            </div>
                            <div class="gpa-progress" style="max-width: 300px;">
                                <div class="gpa-progress-bar" style="width: ${gpaPercent}%"></div>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="display-5 text-primary">${semester.gpa.toFixed(2)}</div>
                            <div class="text-muted">GPA</div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="bi bi-calendar"></i> ${semester.start_date} - ${semester.end_date}
                        </small>
                    </div>
                `;
                
                container.appendChild(card);
            });
            
            // Show first semester details by default
            if (semesters.length > 0) {
                showSemesterDetails(0);
            }
        }
        
        // Show semester details
        function showSemesterDetails(index) {
            if (!studentData || !studentData.semesters[index]) return;
            
            const semester = studentData.semesters[index];
            
            // Update active semester card
            document.querySelectorAll('.semester-card').forEach(card => {
                card.classList.remove('active');
            });
            document.querySelector(`.semester-card[data-semester-index="${index}"]`).classList.add('active');
            
            // Hide semester list, show details
            document.getElementById('semestersContainer').style.display = 'none';
            document.getElementById('semesterDetails').style.display = 'block';
            
            // Update semester details
            document.getElementById('semesterTitle').textContent = semester.name;
            document.getElementById('semesterGpa').textContent = semester.gpa.toFixed(2);
            document.getElementById('semesterCredits').textContent = semester.credits;
            document.getElementById('semesterCourses').textContent = semester.courses.length;
            
            // Update courses table
            const tableBody = document.getElementById('semesterCoursesTable');
            tableBody.innerHTML = '';
            
            let totalGradePoints = 0;
            let totalCredits = 0;
            
            semester.courses.forEach(course => {
                const gradePoint = course.grade_point || 0;
                totalGradePoints += gradePoint * course.credits;
                totalCredits += course.credits;
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${course.code}</td>
                    <td>${course.title}</td>
                    <td>${course.credits}</td>
                    <td>${course.marks || 'N/A'}</td>
                    <td><span class="grade-badge grade-${course.grade || 'F'}">${course.grade || 'N/A'}</span></td>
                    <td>${gradePoint.toFixed(2)}</td>
                    <td><span class="badge bg-${course.status === 'passed' ? 'success' : 'danger'}">${course.status || 'pending'}</span></td>
                `;
                tableBody.appendChild(row);
            });
            
            // Update summary
            document.getElementById('totalSemCredits').textContent = totalCredits;
            document.getElementById('totalGradePoints').textContent = totalGradePoints.toFixed(2);
            document.getElementById('semesterStatus').textContent = semester.status || 'completed';
            document.getElementById('semesterStatus').className = `badge bg-${semester.status === 'completed' ? 'success' : 'warning'}`;
            
            // Update GPA calculation
            const gpa = totalCredits > 0 ? (totalGradePoints / totalCredits).toFixed(2) : '0.00';
            document.getElementById('gpaCalculation').textContent = 
                `${totalGradePoints.toFixed(2)} ÷ ${totalCredits} = ${gpa}`;
        }
        
        // Hide semester details
        function hideSemesterDetails() {
            document.getElementById('semesterDetails').style.display = 'none';
            document.getElementById('semestersContainer').style.display = 'block';
        }
        
        // Toggle full transcript
        document.getElementById('toggleTranscript')?.addEventListener('click', function() {
            const transcript = document.getElementById('fullTranscript');
            const icon = this.querySelector('i');
            
            if (transcript.style.display === 'none') {
                transcript.style.display = 'block';
                icon.className = 'bi bi-chevron-up';
                this.textContent = ' Hide Full Transcript';
                loadFullTranscript();
            } else {
                transcript.style.display = 'none';
                icon.className = 'bi bi-chevron-down';
                this.textContent = ' Show Full Transcript';
            }
        });
        
        // Load full transcript
        function loadFullTranscript() {
            if (!studentData) return;
            
            const tableBody = document.getElementById('transcriptTable');
            tableBody.innerHTML = '';
            
            studentData.semesters.forEach(semester => {
                semester.courses.forEach((course, courseIndex) => {
                    const row = document.createElement('tr');
                    if (courseIndex === 0) {
                        row.innerHTML = `
                            <td rowspan="${semester.courses.length}">
                                <strong>${semester.name}</strong><br>
                                <small class="text-muted">GPA: ${semester.gpa.toFixed(2)}</small>
                            </td>
                            <td>${course.code}</td>
                            <td>${course.title}</td>
                            <td>${course.credits}</td>
                            <td>${course.marks || 'N/A'}</td>
                            <td><span class="grade-badge grade-${course.grade || 'F'}">${course.grade || 'N/A'}</span></td>
                            <td>${(course.grade_point || 0).toFixed(2)}</td>
                            <td>${courseIndex === 0 ? semester.gpa.toFixed(2) : ''}</td>
                        `;
                    } else {
                        row.innerHTML = `
                            <td>${course.code}</td>
                            <td>${course.title}</td>
                            <td>${course.credits}</td>
                            <td>${course.marks || 'N/A'}</td>
                            <td><span class="grade-badge grade-${course.grade || 'F'}">${course.grade || 'N/A'}</span></td>
                            <td>${(course.grade_point || 0).toFixed(2)}</td>
                            <td></td>
                        `;
                    }
                    tableBody.appendChild(row);
                });
            });
        }
        
        // Show student options (for name search with multiple results)
        function showStudentOptions(students) {
            const suggestionsList = document.getElementById('suggestionsList');
            suggestionsList.innerHTML = '';
            
            students.forEach(student => {
                const item = document.createElement('a');
                item.href = '#';
                item.className = 'list-group-item list-group-item-action';
                item.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>${student.name}</strong><br>
                            <small class="text-muted">ID: ${student.id} | ${student.program || ''}</small>
                        </div>
                        <button class="btn btn-sm btn-outline-primary" onclick="searchStudent('${student.id}')">
                            Select
                        </button>
                    </div>
                `;
                suggestionsList.appendChild(item);
            });
            
            document.getElementById('suggestions').style.display = 'block';
        }
        
        // Show suggestions
        function showSuggestions(suggestions) {
            const suggestionsList = document.getElementById('suggestionsList');
            suggestionsList.innerHTML = '';
            
            suggestions.forEach(student => {
                const item = document.createElement('a');
                item.href = '#';
                item.className = 'list-group-item list-group-item-action';
                item.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>${student.name}</strong><br>
                            <small class="text-muted">ID: ${student.id} | ${student.department || ''}</small>
                        </div>
                        <button class="btn btn-sm btn-outline-primary" onclick="searchStudent('${student.id}')">
                            View Results
                        </button>
                    </div>
                `;
                suggestionsList.appendChild(item);
            });
            
            document.getElementById('suggestions').style.display = 'block';
        }
        
        // Hide suggestions
        function hideSuggestions() {
            document.getElementById('suggestions').style.display = 'none';
        }
        
        // Show sample data (for demo purposes)
        function showSampleData() {
            const sampleData = {
                success: true,
                student: {
                    id: "221-35-991",
                    name: "Irfan Kafil Areyan",
                    department: "Software Engineering",
                    batch: "221",
                    program: "B.Sc. in Software Engineering",
                    email: "john.doe@example.com",
                    phone: "+880 1234 567890",
                    avatar: "/images/default-avatar.png"
                },
                summary: {
                    cgpa: 3.75,
                    total_credits: 45,
                    total_courses: 15,
                    total_semesters: 3
                },
                semesters: [
                    {
                        name: "Fall 2023",
                        year: "2023",
                        credits: 15,
                        gpa: 3.8,
                        start_date: "Sep 2023",
                        end_date: "Dec 2023",
                        status: "completed",
                        courses: [
                            { code: "SE101", title: "Introduction to Programming", credits: 3, marks: 85, grade: "A+", grade_point: 4.00, status: "passed" },
                            { code: "MAT101", title: "Calculus I", credits: 3, marks: 88, grade: "A+", grade_point: 4.00, status: "passed" },
                            { code: "ENG101", title: "English Composition", credits: 3, marks: 70, grade: "A-", grade_point: 3.75, status: "passed" },
                            { code: "PHY101", title: "Physics I", credits: 3, marks: 70, grade: "B+", grade_point: 3.3, status: "passed" },
                            { code: "SE100", title: "Computer Fundamentals", credits: 3, marks: 92, grade: "A+", grade_point: 4.00, status: "passed" }
                        ]
                    },
                    {
                        name: "Spring 2024",
                        year: "2024",
                        credits: 15,
                        gpa: 3.7,
                        start_date: "Jan 2024",
                        end_date: "Apr 2024",
                        status: "completed",
                        courses: [
                            { code: "SE201", title: "Data Structures", credits: 3, marks: 87, grade: "A+", grade_point: 4.00, status: "passed" },
                            { code: "MAT201", title: "Discrete Mathematics", credits: 3, marks: 85, grade: "A+", grade_point: 4.00, status: "passed" },
                            { code: "SE203", title: "Digital Logic Design", credits: 3, marks: 78, grade: "A-", grade_point: 3.75, status: "passed" },
                            { code: "STA201", title: "Statistics", credits: 3, marks: 65, grade: "B+", grade_point: 3.25, status: "passed" },
                            { code: "SE205", title: "Object Oriented Programming", credits: 3, marks: 90, grade: "A+", grade_point: 4.00, status: "passed" }
                        ]
                    },
                    {
                        name: "Summer 2024",
                        year: "2024",
                        credits: 15,
                        gpa: 3.75,
                        start_date: "May 2024",
                        end_date: "Aug 2024",
                        status: "completed",
                        courses: [
                            { code: "SE301", title: "Algorithms", credits: 3, marks: 89, grade: "A+", grade_point: 4.00, status: "passed" },
                            { code: "SE303", title: "Database Systems", credits: 3, marks: 84, grade: "A+", grade_point: 4.00, status: "passed" },
                            { code: "SE305", title: "Computer Architecture", credits: 3, marks: 75, grade: "A-", grade_point: 3.75, status: "passed" },
                            { code: "MAT301", title: "Linear Algebra", credits: 3, marks: 72, grade: "B+", grade_point: 3.25, status: "passed" },
                            { code: "SE307", title: "Software Engineering", credits: 3, marks: 88, grade: "A", grade_point: 4.00, status: "passed" }
                        ]
                    }
                ]
            };
            
            displayStudentResults(sampleData);
        }
        
        // UI Helper Functions
        function showLoading() {
            document.getElementById('loadingSpinner').style.display = 'block';
            document.getElementById('studentInfoSection').style.display = 'none';
            document.getElementById('emptyState').style.display = 'none';
        }
        
        function hideLoading() {
            document.getElementById('loadingSpinner').style.display = 'none';
        }
        
        function showEmptyState() {
            document.getElementById('emptyState').style.display = 'block';
            document.getElementById('studentInfoSection').style.display = 'none';
        }
        
        function hideEmptyState() {
            document.getElementById('emptyState').style.display = 'none';
        }
        
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Close suggestions when clicking outside
        document.addEventListener('click', function(event) {
            const suggestions = document.getElementById('suggestions');
            const nameInput = document.getElementById('studentName');
            
            if (suggestions && suggestions.style.display !== 'none' && 
                !suggestions.contains(event.target) && 
                event.target !== nameInput) {
                suggestions.style.display = 'none';
            }
        });
    </script>
</body>
</html>