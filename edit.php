<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Registration</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-back {
            background: #6c757d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            background: #5a6268;
        }

        #loading {
            text-align: center;
            padding: 50px;
            color: white;
            font-size: 18px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="loading">Loading registration data...</div>
        
        <div id="editFormContainer" class="hidden">
            <div class="header-actions">
                <h1 style="color: white; margin: 0;">Edit Registration</h1>
                <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>
            </div>

            <div id="successMessage" class="success-message">
                ✓ Registration updated successfully!
            </div>
            
            <form id="sssForm" novalidate>
                <input type="hidden" name="id" id="registrant_id">
                
                <!-- Personal Information Section -->
                <div class="form-section">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Last Name *</label>
                            <input type="text" name="last_name" id="last_name">
                            <span class="error" id="last_name_error">Last name is required</span>
                        </div>
                        <div class="form-group">
                            <label>First Name *</label>
                            <input type="text" name="first_name" id="first_name">
                            <span class="error" id="first_name_error">First name is required</span>
                        </div>
                        <div class="form-group">
                            <label>Middle Name *</label>
                            <input type="text" name="middle_name" id="middle_name">
                            <span class="error" id="middle_name_error">Middle name is required</span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Date of Birth *</label>
                            <input type="date" name="dob" id="dob">
                            <span class="error" id="dob_error">Date of birth is required</span>
                        </div>
                        <div class="form-group">
                            <label>Sex *</label>
                            <div class="radio-group">
                                <label><input type="radio" name="sex" value="Male"> Male</label>
                                <label><input type="radio" name="sex" value="Female"> Female</label>
                            </div>
                            <span class="error" id="sex_error">Sex is required</span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Civil Status *</label>
                            <select name="civil_status" id="civil_status">
                                <option value="">Select</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Legally Separated">Legally Separated</option>
                                <option value="Others">Others</option>
                            </select>
                            <span class="error" id="civil_status_error">Civil status is required</span>
                        </div>
                        <div class="form-group">
                            <label>Nationality *</label>
                            <input type="text" name="nationality" id="nationality">
                            <span class="error" id="nationality_error">Nationality is required</span>
                        </div>
                    </div>
                </div>
                
                <!-- Address Section -->
                <div class="form-section">
                    <div class="form-row">
                        <div class="form-group full">
                            <label>Place of Birth *</label>
                            <input type="text" name="place_of_birth" id="place_of_birth" placeholder="City/Country, Province">
                            <span class="error" id="place_of_birth_error">Place of birth is required</span>
                        </div>
                    </div>
                    
                    <div class="checkbox-group">
                        <input type="checkbox" id="same_address" name="same_address">
                        <label for="same_address">The same with Home Address</label>
                    </div>
                    
                    <div class="form-row" id="home_address_row">
                        <div class="form-group full">
                            <label>Home Address *</label>
                            <input type="text" name="home_address" id="home_address" placeholder="House/Lot No. & Bldg. Name, Street Name, Subdivision">
                            <span class="error" id="home_address_error">Home address is required</span>
                        </div>
                    </div>
                </div>
                
                <!-- Contact and Parent Information Section -->
                <div class="form-section">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Mobile/Cellphone Number *</label>
                            <input type="tel" name="mobile_number" id="mobile_number" placeholder="09XXXXXXXXX">
                            <span class="error" id="mobile_number_error">Mobile number is required</span>
                        </div>
                        <div class="form-group">
                            <label>E-mail Address *</label>
                            <input type="text" name="email" id="email">
                            <span class="error" id="email_error">Valid email is required</span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Mother's Maiden Name - Last Name *</label>
                            <input type="text" name="mother_last_name" id="mother_last_name">
                            <span class="error" id="mother_last_name_error">Mother's last name is required</span>
                        </div>
                        <div class="form-group">
                            <label>First Name *</label>
                            <input type="text" name="mother_first_name" id="mother_first_name">
                            <span class="error" id="mother_first_name_error">Mother's first name is required</span>
                        </div>
                        <div class="form-group">
                            <label>Middle Name *</label>
                            <input type="text" name="mother_middle_name" id="mother_middle_name">
                            <span class="error" id="mother_middle_name_error">Mother's middle name is required</span>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Father's Name - Last Name *</label>
                            <input type="text" name="father_last_name" id="father_last_name">
                            <span class="error" id="father_last_name_error">Father's last name is required</span>
                        </div>
                        <div class="form-group">
                            <label>First Name *</label>
                            <input type="text" name="father_first_name" id="father_first_name">
                            <span class="error" id="father_first_name_error">Father's first name is required</span>
                        </div>
                        <div class="form-group">
                            <label>Middle Name *</label>
                            <input type="text" name="father_middle_name" id="father_middle_name">
                            <span class="error" id="father_middle_name_error">Father's middle name is required</span>
                        </div>
                    </div>
                </div>
                
                <!-- Dependents/Beneficiaries Section -->
                <div class="form-section">
                    <div class="section-header">
                        <h3>B. DEPENDENT(S)/BENEFICIARY/IES</h3>
                    </div>
                    
                    <h4>SPOUSE</h4>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Last Name *</label>
                            <input type="text" name="spouse_last_name" id="spouse_last_name">
                            <span class="error" id="spouse_last_name_error">Spouse's last name is required</span>
                        </div>
                        <div class="form-group">
                            <label>First Name *</label>
                            <input type="text" name="spouse_first_name" id="spouse_first_name">
                            <span class="error" id="spouse_first_name_error">Spouse's first name is required</span>
                        </div>
                        <div class="form-group">
                            <label>Middle Name *</label>
                            <input type="text" name="spouse_middle_name" id="spouse_middle_name">
                            <span class="error" id="spouse_middle_name_error">Spouse's middle name is required</span>
                        </div>
                        <div class="form-group">
                            <label>Suffix</label>
                            <select name="spouse_suffix" id="spouse_suffix">
                                <option value="">-- Select Suffix --</option>
                                <option value="Jr.">Jr.</option>
                                <option value="Sr.">Sr.</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Date of Birth (MM/DD/YYYY) *</label>
                            <input type="date" name="spouse_dob" id="spouse_dob">
                            <span class="error" id="spouse_dob_error">Spouse's date of birth is required</span>
                        </div>
                    </div>
                    
                    <h4>CHILDREN</h4>
                    <div id="children_container"></div>
                    <button type="button" class="add-child-btn" id="addChildBtn">+ Add Another Child</button>
                    
                    <h4>OTHER BENEFICIARY/IES <span class="subtitle-note">(if without spouse & child and parents are both deceased)</span></h4>
                    <div id="beneficiaries_container"></div>
                    <button type="button" class="add-beneficiary-btn" id="addBeneficiaryBtn">+ Add Another Beneficiary</button>
                </div>
                
                <button type="submit" class="submit-btn">Update Registration</button>
            </form>
        </div>
    </div>

    <script>
        const registrantId = new URLSearchParams(window.location.search).get('id');
        let childCount = 0;
        let beneficiaryCount = 0;

        // Load registration data
        async function loadRegistration() {
            try {
                const response = await fetch(`get_registration.php?id=${registrantId}`);
                const result = await response.json();

                if (!result.success) {
                    alert('Error loading registration: ' + result.message);
                    window.location.href = 'dashboard.php';
                    return;
                }

                const data = result.data;
                populateForm(data);
                
                document.getElementById('loading').classList.add('hidden');
                document.getElementById('editFormContainer').classList.remove('hidden');
            } catch (error) {
                console.error('Error:', error);
                alert('Error loading registration data');
                window.location.href = 'dashboard.php';
            }
        }

        function populateForm(data) {
            // Populate main registrant data
            const registrant = data.registrant;
            document.getElementById('registrant_id').value = registrant.id;
            document.getElementById('last_name').value = registrant.last_name || '';
            document.getElementById('first_name').value = registrant.first_name || '';
            document.getElementById('middle_name').value = registrant.middle_name || '';
            document.getElementById('dob').value = registrant.date_of_birth || '';
            
            // Set radio button
            if (registrant.sex) {
                document.querySelector(`input[name="sex"][value="${registrant.sex}"]`).checked = true;
            }
            
            document.getElementById('civil_status').value = registrant.civil_status || '';
            document.getElementById('nationality').value = registrant.nationality || '';
            document.getElementById('place_of_birth').value = registrant.place_of_birth || '';
            document.getElementById('same_address').checked = registrant.same_address == 1;
            document.getElementById('home_address').value = registrant.home_address || '';
            document.getElementById('mobile_number').value = registrant.mobile_number || '';
            document.getElementById('email').value = registrant.email || '';
            
            document.getElementById('mother_last_name').value = registrant.mother_last_name || '';
            document.getElementById('mother_first_name').value = registrant.mother_first_name || '';
            document.getElementById('mother_middle_name').value = registrant.mother_middle_name || '';
            document.getElementById('father_last_name').value = registrant.father_last_name || '';
            document.getElementById('father_first_name').value = registrant.father_first_name || '';
            document.getElementById('father_middle_name').value = registrant.father_middle_name || '';

            // Populate spouse data
            if (data.spouse) {
                document.getElementById('spouse_last_name').value = data.spouse.last_name || '';
                document.getElementById('spouse_first_name').value = data.spouse.first_name || '';
                document.getElementById('spouse_middle_name').value = data.spouse.middle_name || '';
                document.getElementById('spouse_suffix').value = data.spouse.suffix || '';
                document.getElementById('spouse_dob').value = data.spouse.date_of_birth || '';
            }

            // Populate children
            if (data.children && data.children.length > 0) {
                data.children.forEach((child, index) => {
                    addChildRow(index + 1, child);
                });
            } else {
                addChildRow(1);
            }

            // Populate beneficiaries
            if (data.beneficiaries && data.beneficiaries.length > 0) {
                data.beneficiaries.forEach((beneficiary, index) => {
                    addBeneficiaryRow(index + 1, beneficiary);
                });
            } else {
                addBeneficiaryRow(1);
            }
        }

        function addChildRow(index, data = null) {
            childCount = Math.max(childCount, index);
            const container = document.getElementById('children_container');
            
            const childDiv = document.createElement('div');
            childDiv.className = 'dependent-row';
            childDiv.setAttribute('data-index', index);
            childDiv.innerHTML = `
                <div class="dependent-number">${index}.</div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="child_last_name_${index}" id="child_last_name_${index}" value="${data?.last_name || ''}">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="child_first_name_${index}" id="child_first_name_${index}" value="${data?.first_name || ''}">
                    </div>
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="child_middle_name_${index}" id="child_middle_name_${index}" value="${data?.middle_name || ''}">
                    </div>
                    <div class="form-group" style="max-width: 140px;">
                        <label>Suffix</label>
                        <select name="child_suffix_${index}" id="child_suffix_${index}">
                            <option value="">-- Select Suffix --</option>
                            <option value="Jr." ${data?.suffix === 'Jr.' ? 'selected' : ''}>Jr.</option>
                            <option value="Sr." ${data?.suffix === 'Sr.' ? 'selected' : ''}>Sr.</option>
                            <option value="II" ${data?.suffix === 'II' ? 'selected' : ''}>II</option>
                            <option value="III" ${data?.suffix === 'III' ? 'selected' : ''}>III</option>
                            <option value="IV" ${data?.suffix === 'IV' ? 'selected' : ''}>IV</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group" style="max-width: 250px;">
                        <label>Date of Birth</label>
                        <input type="date" name="child_dob_${index}" id="child_dob_${index}" value="${data?.date_of_birth || ''}">
                    </div>
                </div>
            `;
            container.appendChild(childDiv);
        }

        function addBeneficiaryRow(index, data = null) {
            beneficiaryCount = Math.max(beneficiaryCount, index);
            const container = document.getElementById('beneficiaries_container');
            
            const beneficiaryDiv = document.createElement('div');
            beneficiaryDiv.className = 'dependent-row';
            beneficiaryDiv.setAttribute('data-index', index);
            beneficiaryDiv.innerHTML = `
                <div class="dependent-number">${index}.</div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="beneficiary_last_name_${index}" id="beneficiary_last_name_${index}" value="${data?.last_name || ''}">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="beneficiary_first_name_${index}" id="beneficiary_first_name_${index}" value="${data?.first_name || ''}">
                    </div>
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="beneficiary_middle_name_${index}" id="beneficiary_middle_name_${index}" value="${data?.middle_name || ''}">
                    </div>
                    <div class="form-group">
                        <label>Suffix</label>
                        <select name="beneficiary_suffix_${index}" id="beneficiary_suffix_${index}">
                            <option value="">-- Select Suffix --</option>
                            <option value="Jr." ${data?.suffix === 'Jr.' ? 'selected' : ''}>Jr.</option>
                            <option value="Sr." ${data?.suffix === 'Sr.' ? 'selected' : ''}>Sr.</option>
                            <option value="II" ${data?.suffix === 'II' ? 'selected' : ''}>II</option>
                            <option value="III" ${data?.suffix === 'III' ? 'selected' : ''}>III</option>
                            <option value="IV" ${data?.suffix === 'IV' ? 'selected' : ''}>IV</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Relationship</label>
                        <input type="text" name="beneficiary_relationship_${index}" id="beneficiary_relationship_${index}" placeholder="e.g., Sibling, Parent" value="${data?.relationship || ''}">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth (MM/DD/YYYY)</label>
                        <input type="date" name="beneficiary_dob_${index}" id="beneficiary_dob_${index}" value="${data?.date_of_birth || ''}">
                    </div>
                </div>
            `;
            container.appendChild(beneficiaryDiv);
        }

        // Add child button
        document.getElementById('addChildBtn').addEventListener('click', () => {
            childCount++;
            addChildRow(childCount);
        });

        // Add beneficiary button
        document.getElementById('addBeneficiaryBtn').addEventListener('click', () => {
            beneficiaryCount++;
            addBeneficiaryRow(beneficiaryCount);
        });

        // Form submission
        document.getElementById('sssForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            
            try {
                const response = await fetch('update_form.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    window.location.href = 'dashboard.php?success=updated';
                } else {
                    alert('Error: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error updating registration');
            }
        });

        // Load data on page load
        if (registrantId) {
            loadRegistration();
        } else {
            alert('No registration ID provided');
            window.location.href = 'dashboard.php';
        }
    </script>
</body>
</html>