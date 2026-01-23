// Handle same address checkbox
const sameAddressCheckbox = document.getElementById('same_address');
const homeAddressRow = document.getElementById('home_address_row');
const homeAddressInput = document.getElementById('home_address');
const placeOfBirthInput = document.getElementById('place_of_birth');

// Track number of children and beneficiaries
let childCount = 1;
let beneficiaryCount = 1;

document.addEventListener('DOMContentLoaded', () => {
    const childrenContainer = document.getElementById('children_container');
    const addChildBtn = document.getElementById('addChildBtn');

    // Initial count
    childCount = document.querySelectorAll('#children_container .dependent-row').length || 1;

    // ADD CHILD
    addChildBtn.addEventListener('click', () => {
        if (childCount >= 5) {
            alert('Maximum of 5 children allowed');
            return;
        }

        childCount++;

        const newRow = document.createElement('div');
        newRow.className = 'dependent-row';
        newRow.setAttribute('data-index', childCount);
        newRow.innerHTML = `
            <div class="dependent-number">${childCount}.</div>

            <!-- Row 1: Names -->
            <div class="form-row">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="child_last_name_${childCount}" id="child_last_name_${childCount}">
                    <span class="error" id="child_last_name_${childCount}_error"></span>
                </div>

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="child_first_name_${childCount}" id="child_first_name_${childCount}">
                    <span class="error" id="child_first_name_${childCount}_error"></span>
                </div>

                <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" name="child_middle_name_${childCount}" id="child_middle_name_${childCount}">
                </div>

                <div class="form-group" style="max-width:140px;">
                    <label>Suffix</label>
                    <input type="text" name="child_suffix_${childCount}" id="child_suffix_${childCount}" placeholder="Jr., Sr., III">
                </div>
            </div>

            <!-- Row 2: DOB -->
            <div class="form-row">
                <div class="form-group" style="max-width:250px;">
                    <label>Date of Birth</label>
                    <input type="date" name="child_dob_${childCount}" id="child_dob_${childCount}">
                    <span class="error" id="child_dob_${childCount}_error"></span>
                </div>
            </div>

            <button type="button" class="remove-btn">Remove</button>
        `;


        childrenContainer.appendChild(newRow);
    });

    // REMOVE CHILD
    childrenContainer.addEventListener('click', (e) => {
        if (!e.target.classList.contains('remove-btn')) return;

        const rows = childrenContainer.querySelectorAll('.dependent-row');
        if (rows.length <= 1) {
            alert('At least one child entry must remain');
            return;
        }

        e.target.closest('.dependent-row').remove();
        renumberChildren();
    });

    // RENUMBER CHILDREN
    function renumberChildren() {
        const rows = childrenContainer.querySelectorAll('.dependent-row');
        childCount = rows.length;

        rows.forEach((row, index) => {
            const newIndex = index + 1;
            row.setAttribute('data-index', newIndex);
            row.querySelector('.dependent-number').textContent = `${newIndex}.`;

            row.querySelectorAll('input').forEach(input => {
                const oldName = input.name;
                const oldId = input.id;

                if (oldName?.includes('child_')) {
                    const base = oldName.replace(/_\d+$/, '');
                    input.name = `${base}_${newIndex}`;
                }

                if (oldId?.includes('child_')) {
                    const base = oldId.replace(/_\d+$/, '');
                    input.id = `${base}_${newIndex}`;
                }
            });

            row.querySelectorAll('.error').forEach(span => {
                const oldId = span.id;
                if (oldId?.includes('child_') && oldId.endsWith('_error')) {
                    const base = oldId.replace(/_\d+_error$/, '');
                    span.id = `${base}_${newIndex}_error`;
                }
            });
        });
    }
});

// ADD BENEFICIARY
document.getElementById('addBeneficiaryBtn').addEventListener('click', function() {
    if (beneficiaryCount >= 2) {
        alert('Maximum of 2 beneficiaries can be added');
        return;
    }
    
    beneficiaryCount++;
    const beneficiariesContainer = document.getElementById('beneficiaries_container');
    const newBeneficiary = document.createElement('div');
    newBeneficiary.className = 'dependent-row';
    newBeneficiary.setAttribute('data-index', beneficiaryCount);
    newBeneficiary.innerHTML = `
        <div class="dependent-number">${beneficiaryCount}.</div>
        <div class="form-row">
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="beneficiary_last_name_${beneficiaryCount}" id="beneficiary_last_name_${beneficiaryCount}">
                <span class="error" id="beneficiary_last_name_${beneficiaryCount}_error"></span>
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="beneficiary_first_name_${beneficiaryCount}" id="beneficiary_first_name_${beneficiaryCount}">
                <span class="error" id="beneficiary_first_name_${beneficiaryCount}_error"></span>
            </div>
            <div class="form-group">
                <label>Middle Name</label>
                <input type="text" name="beneficiary_middle_name_${beneficiaryCount}" id="beneficiary_middle_name_${beneficiaryCount}">
            </div>
            <div class="form-group">
                <label>Suffix</label>
                <input type="text" name="beneficiary_suffix_${beneficiaryCount}" id="beneficiary_suffix_${beneficiaryCount}" placeholder="Jr., Sr., III">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Relationship</label>
                <input type="text" name="beneficiary_relationship_${beneficiaryCount}" id="beneficiary_relationship_${beneficiaryCount}" placeholder="e.g., Sibling, Parent">
                <span class="error" id="beneficiary_relationship_${beneficiaryCount}_error"></span>
            </div>
            <div class="form-group">
                <label>Date of Birth (MM/DD/YYYY)</label>
                <input type="date" name="beneficiary_dob_${beneficiaryCount}" id="beneficiary_dob_${beneficiaryCount}">
                <span class="error" id="beneficiary_dob_${beneficiaryCount}_error"></span>
            </div>
        </div>
        <button type="button" class="remove-btn">Remove</button>
    `;
    beneficiariesContainer.appendChild(newBeneficiary);
});

// REMOVE BENEFICIARY
document.getElementById('beneficiaries_container').addEventListener('click', function(e) {
    if (!e.target.classList.contains('remove-btn')) return;

    const rows = document.querySelectorAll('#beneficiaries_container .dependent-row');
    if (rows.length <= 1) {
        alert('At least one beneficiary entry must remain');
        return;
    }
    
    e.target.closest('.dependent-row').remove();
    renumberBeneficiaries();
});

// RENUMBER BENEFICIARIES
function renumberBeneficiaries() {
    const rows = document.querySelectorAll('#beneficiaries_container .dependent-row');
    beneficiaryCount = rows.length;

    rows.forEach((row, index) => {
        const newIndex = index + 1;
        row.setAttribute('data-index', newIndex);
        row.querySelector('.dependent-number').textContent = `${newIndex}.`;

        row.querySelectorAll('input').forEach(input => {
            const name = input.name;
            const id = input.id;
            
            if (name?.includes('beneficiary_')) {
                const base = name.replace(/_\d+$/, '');
                input.name = `${base}_${newIndex}`;
            }
            if (id?.includes('beneficiary_')) {
                const base = id.replace(/_\d+$/, '');
                input.id = `${base}_${newIndex}`;
            }
        });

        row.querySelectorAll('.error').forEach(span => {
            const id = span.id;
            if (id?.includes('beneficiary_') && id.endsWith('_error')) {
                const base = id.replace(/_\d+_error$/, '');
                span.id = `${base}_${newIndex}_error`;
            }
        });
    });
}

// RESET DEPENDENTS
function resetDependents() {
    const childrenContainer = document.getElementById('children_container');
    childrenContainer.innerHTML = `
        <div class="dependent-row" data-index="1">
            <div class="dependent-number">1.</div>
            <div class="form-row">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="child_last_name_1" id="child_last_name_1">
                    <span class="error" id="child_last_name_1_error"></span>
                </div>
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="child_first_name_1" id="child_first_name_1">
                    <span class="error" id="child_first_name_1_error"></span>
                </div>
                <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" name="child_middle_name_1" id="child_middle_name_1">
                </div>
                <div class="form-group">
                    <label>Suffix</label>
                    <input type="text" name="child_suffix_1" id="child_suffix_1" placeholder="Jr., Sr., III">
                </div>
                <div class="form-group">
                    <label>Date of Birth (MM/DD/YYYY)</label>
                    <input type="date" name="child_dob_1" id="child_dob_1">
                    <span class="error" id="child_dob_1_error"></span>
                </div>
            </div>
        </div>
    `;
    childCount = 1;
    
    const beneficiariesContainer = document.getElementById('beneficiaries_container');
    beneficiariesContainer.innerHTML = `
        <div class="dependent-row" data-index="1">
            <div class="dependent-number">1.</div>
            <div class="form-row">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="beneficiary_last_name_1" id="beneficiary_last_name_1">
                    <span class="error" id="beneficiary_last_name_1_error"></span>
                </div>
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="beneficiary_first_name_1" id="beneficiary_first_name_1">
                    <span class="error" id="beneficiary_first_name_1_error"></span>
                </div>
                <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" name="beneficiary_middle_name_1" id="beneficiary_middle_name_1">
                </div>
                <div class="form-group">
                    <label>Suffix</label>
                    <input type="text" name="beneficiary_suffix_1" id="beneficiary_suffix_1" placeholder="Jr., Sr., III">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Relationship</label>
                    <input type="text" name="beneficiary_relationship_1" id="beneficiary_relationship_1" placeholder="e.g., Sibling, Parent">
                    <span class="error" id="beneficiary_relationship_1_error"></span>
                </div>
                <div class="form-group">
                    <label>Date of Birth (MM/DD/YYYY)</label>
                    <input type="date" name="beneficiary_dob_1" id="beneficiary_dob_1">
                    <span class="error" id="beneficiary_dob_1_error"></span>
                </div>
            </div>
        </div>
    `;
    beneficiaryCount = 1;
}

// SAME ADDRESS CHECKBOX
sameAddressCheckbox.addEventListener('change', function() {
    if (this.checked) {
        homeAddressRow.style.display = 'none';
        homeAddressInput.value = placeOfBirthInput.value;
    } else {
        homeAddressRow.style.display = 'flex';
    }
});

placeOfBirthInput.addEventListener('input', function() {
    if (sameAddressCheckbox.checked) {
        homeAddressInput.value = this.value;
    }
});

// FORM VALIDATION AND SUBMISSION
document.getElementById('sssForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Reset errors
    document.querySelectorAll('.error').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.input-error').forEach(el => el.classList.remove('input-error'));
    
    let isValid = true;
    
    // Validate required fields
    const requiredFields = [
        { id: 'last_name', message: 'Last name is required' },
        { id: 'first_name', message: 'First name is required' },
        { id: 'middle_name', message: 'Middle name is required' },
        { id: 'dob', message: 'Date of birth is required' },
        { id: 'civil_status', message: 'Civil status is required' },
        { id: 'nationality', message: 'Nationality is required' },
        { id: 'place_of_birth', message: 'Place of birth is required' },
        { id: 'mobile_number', message: 'Mobile number is required' },
        { id: 'email', message: 'Email is required' },
        { id: 'mother_last_name', message: "Mother's last name is required" },
        { id: 'mother_first_name', message: "Mother's first name is required" },
        { id: 'mother_middle_name', message: "Mother's middle name is required" },
        { id: 'father_last_name', message: "Father's last name is required" },
        { id: 'father_first_name', message: "Father's first name is required" },
        { id: 'father_middle_name', message: "Father's middle name is required" },
        { id: 'spouse_last_name', message: "Spouse's last name is required" },
        { id: 'spouse_first_name', message: "Spouse's first name is required" },
        { id: 'spouse_middle_name', message: "Spouse's middle name is required" },
        { id: 'spouse_dob', message: "Spouse's date of birth is required" }
    ];
    
    requiredFields.forEach(field => {
        const input = document.getElementById(field.id);
        if (!input.value.trim()) {
            document.getElementById(field.id + '_error').textContent = field.message;
            document.getElementById(field.id + '_error').style.display = 'block';
            input.classList.add('input-error');
            isValid = false;
        }
    });
    
    // Validate sex radio buttons
    const sexRadio = document.querySelector('input[name="sex"]:checked');
    if (!sexRadio) {
        document.getElementById('sex_error').style.display = 'block';
        isValid = false;
    }
    
    // Validate home address if checkbox is not checked
    if (!sameAddressCheckbox.checked) {
        if (!homeAddressInput.value.trim()) {
            document.getElementById('home_address_error').style.display = 'block';
            homeAddressInput.classList.add('input-error');
            isValid = false;
        }
    } else {
        homeAddressInput.value = placeOfBirthInput.value;
    }
    
    // Validate email format
    const emailInput = document.getElementById('email');
    const emailValue = emailInput.value.trim();
    
    if (emailValue) {
        if (!emailValue.includes('@')) {
            document.getElementById('email_error').textContent = 'Email must contain @';
            document.getElementById('email_error').style.display = 'block';
            emailInput.classList.add('input-error');
            isValid = false;
        } else if (emailValue.indexOf('@') === 0) {
            document.getElementById('email_error').textContent = 'Email must have text before @';
            document.getElementById('email_error').style.display = 'block';
            emailInput.classList.add('input-error');
            isValid = false;
        } else if (emailValue.indexOf('@') === emailValue.length - 1) {
            document.getElementById('email_error').textContent = 'Email must have text after @';
            document.getElementById('email_error').style.display = 'block';
            emailInput.classList.add('input-error');
            isValid = false;
        } else if (!emailValue.split('@')[1].includes('.')) {
            document.getElementById('email_error').textContent = 'Email must contain a dot (.) after @';
            document.getElementById('email_error').style.display = 'block';
            emailInput.classList.add('input-error');
            isValid = false;
        } else if (emailValue.split('.').pop().length < 2) {
            document.getElementById('email_error').textContent = 'Email domain is too short';
            document.getElementById('email_error').style.display = 'block';
            emailInput.classList.add('input-error');
            isValid = false;
        }
    }
    
    // Validate mobile number format
    const mobileInput = document.getElementById('mobile_number');
    const mobileValue = mobileInput.value.trim();
    
    if (mobileValue) {
        if (!mobileValue.startsWith('09')) {
            document.getElementById('mobile_number_error').textContent = 'Mobile number must start with 09';
            document.getElementById('mobile_number_error').style.display = 'block';
            mobileInput.classList.add('input-error');
            isValid = false;
        } else if (mobileValue.length !== 11) {
            document.getElementById('mobile_number_error').textContent = 'Mobile number must be exactly 11 digits';
            document.getElementById('mobile_number_error').style.display = 'block';
            mobileInput.classList.add('input-error');
            isValid = false;
        } else if (!/^\d+$/.test(mobileValue)) {
            document.getElementById('mobile_number_error').textContent = 'Mobile number must contain only numbers';
            document.getElementById('mobile_number_error').style.display = 'block';
            mobileInput.classList.add('input-error');
            isValid = false;
        }
    }
    
    // Validate SPOUSE - Conditional validation
    const spouseLastName = document.getElementById('spouse_last_name');
    const spouseFirstName = document.getElementById('spouse_first_name');
    const spouseMiddleName = document.getElementById('spouse_middle_name');
    const spouseDob = document.getElementById('spouse_dob');
    
    const hasAnySpouseValue = spouseLastName.value.trim() || spouseFirstName.value.trim() || 
                              spouseMiddleName.value.trim() || spouseDob.value.trim();
    
    if (hasAnySpouseValue) {
        if (!spouseLastName.value.trim()) {
            document.getElementById('spouse_last_name_error').textContent = "Spouse's last name is required";
            document.getElementById('spouse_last_name_error').style.display = 'block';
            spouseLastName.classList.add('input-error');
            isValid = false;
        }
        if (!spouseFirstName.value.trim()) {
            document.getElementById('spouse_first_name_error').textContent = "Spouse's first name is required";
            document.getElementById('spouse_first_name_error').style.display = 'block';
            spouseFirstName.classList.add('input-error');
            isValid = false;
        }
        if (!spouseMiddleName.value.trim()) {
            document.getElementById('spouse_middle_name_error').textContent = "Spouse's middle name is required";
            document.getElementById('spouse_middle_name_error').style.display = 'block';
            spouseMiddleName.classList.add('input-error');
            isValid = false;
        }
        if (!spouseDob.value.trim()) {
            document.getElementById('spouse_dob_error').textContent = "Spouse's date of birth is required";
            document.getElementById('spouse_dob_error').style.display = 'block';
            spouseDob.classList.add('input-error');
            isValid = false;
        }
    }
    
    // Validate CHILDREN - Conditional validation
    const childRows = document.querySelectorAll('#children_container .dependent-row');

    childRows.forEach((row) => {
        const rowIndex = row.getAttribute('data-index');

        const lastName = document.getElementById(`child_last_name_${rowIndex}`);
        const firstName = document.getElementById(`child_first_name_${rowIndex}`);
        const dob = document.getElementById(`child_dob_${rowIndex}`);

        // Clear previous errors
        [lastName, firstName, dob].forEach(field => {
            if (!field) return;
            field.classList.remove('input-error');
            const errorEl = document.getElementById(`${field.id}_error`);
            if (errorEl) errorEl.style.display = 'none';
        });

        // Check if user started filling this child
        const hasAnyValue =
            (lastName && lastName.value.trim() !== '') ||
            (firstName && firstName.value.trim() !== '') ||
            (dob && dob.value !== '');

        // If optional child is used → validate required fields
        if (hasAnyValue) {

            if (!lastName || lastName.value.trim() === '') {
                const errorEl = document.getElementById(`child_last_name_${rowIndex}_error`);
                if (errorEl) {
                    errorEl.textContent = 'Last name is required';
                    errorEl.style.display = 'block';
                }
                if (lastName) lastName.classList.add('input-error');
                isValid = false;
            }

            if (!firstName || firstName.value.trim() === '') {
                const errorEl = document.getElementById(`child_first_name_${rowIndex}_error`);
                if (errorEl) {
                    errorEl.textContent = 'First name is required';
                    errorEl.style.display = 'block';
                }
                if (firstName) firstName.classList.add('input-error');
                isValid = false;
            }

            if (!dob || dob.value === '') {
                const errorEl = document.getElementById(`child_dob_${rowIndex}_error`);
                if (errorEl) {
                    errorEl.textContent = 'Date of birth is required';
                    errorEl.style.display = 'block';
                }
                if (dob) dob.classList.add('input-error');
                isValid = false;
            }
        }
    });

    
    // Validate BENEFICIARIES - Conditional validation
    const beneficiaryRows = document.querySelectorAll('#beneficiaries_container .dependent-row');
    beneficiaryRows.forEach((row) => {
        const rowIndex = row.getAttribute('data-index');
        const lastName = document.getElementById(`beneficiary_last_name_${rowIndex}`);
        const firstName = document.getElementById(`beneficiary_first_name_${rowIndex}`);
        const relationship = document.getElementById(`beneficiary_relationship_${rowIndex}`);
        const dob = document.getElementById(`beneficiary_dob_${rowIndex}`);
        
        const hasAnyValue = (lastName && lastName.value.trim()) || 
                           (firstName && firstName.value.trim()) || 
                           (relationship && relationship.value.trim()) ||
                           (dob && dob.value.trim());
        
        if (hasAnyValue) {
            if (!lastName || !lastName.value.trim()) {
                const errorEl = document.getElementById(`beneficiary_last_name_${rowIndex}_error`);
                if (errorEl) {
                    errorEl.textContent = 'Last name is required';
                    errorEl.style.display = 'block';
                }
                if (lastName) lastName.classList.add('input-error');
                isValid = false;
            }
            
            if (!firstName || !firstName.value.trim()) {
                const errorEl = document.getElementById(`beneficiary_first_name_${rowIndex}_error`);
                if (errorEl) {
                    errorEl.textContent = 'First name is required';
                    errorEl.style.display = 'block';
                }
                if (firstName) firstName.classList.add('input-error');
                isValid = false;
            }
            
            if (!relationship || !relationship.value.trim()) {
                const errorEl = document.getElementById(`beneficiary_relationship_${rowIndex}_error`);
                if (errorEl) {
                    errorEl.textContent = 'Relationship is required';
                    errorEl.style.display = 'block';
                }
                if (relationship) relationship.classList.add('input-error');
                isValid = false;
            }
            
            if (!dob || !dob.value.trim()) {
                const errorEl = document.getElementById(`beneficiary_dob_${rowIndex}_error`);
                if (errorEl) {
                    errorEl.textContent = 'Date of birth is required';
                    errorEl.style.display = 'block';
                }
                if (dob) dob.classList.add('input-error');
                isValid = false;
            }
        }
    });
    
    if (isValid) {
        const submitBtn = document.querySelector('.submit-btn');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting...';
        
        const formData = new FormData(this);
        
        fetch('submit_form.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const successMessage = document.getElementById('successMessage');
                successMessage.textContent = '✓ ' + data.message + ' All fields have been cleared.';
                successMessage.classList.add('show');
                
                document.getElementById('sssForm').reset();
                homeAddressRow.style.display = 'flex';
                resetDependents();
                
                window.scrollTo({ top: 0, behavior: 'smooth' });
                
                setTimeout(() => {
                    successMessage.classList.remove('show');
                }, 5000);
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting the form. Please try again.');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Submit';
        });
    } else {
        const firstError = document.querySelector('.input-error');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
});