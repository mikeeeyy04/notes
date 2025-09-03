<div class="modal fade" id="addPayroll" tabindex="-1" aria-labelledby="payrollModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payrollModalLabel">New Payroll</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="payrollForm" method="POST" action="{{ route('payroll.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6"> <label for="employee_id" class="form-label">Employee</label> <select
                                name="employee_id" id="employee_id" class="form-select" required>
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"> {{ $employee->firstName }}
                                        {{ $employee->middleName }} {{ $employee->lastName }} </option>
                                @endforeach
                            </select> </div>
                        <div class="col-md-6">
                            <label for="pay_date" class="form-label">Pay Date</label>
                            <input type="date" name="pay_date" id="pay_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deductions</label>
                        <div id="deductions-list"></div>
                        <button type="button" class="btn btn-outline-dark btn-sm mt-2" id="addDeductionBtn">
                            Add Deduction
                        </button>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label class="form-label">Total Hours (Unit)</label>
                            <input type="text" id="unitDisplay" class="form-control" value="-" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Rate (Salary)</label>
                            <input type="text" id="rateDisplay" class="form-control" value="-" readonly>
                        </div>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Total</th>
                                    <th>Deductions</th>
                                    <th>Gross Pay</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="totalCell">-</td>
                                    <td id="deductionsCell">-</td>
                                    <td id="grossPayCell">-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark" form="payrollForm">Save Payroll</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    let deductionIndex = 0;


    function updatePayrollTable() {
        const employeeId = document.getElementById('employee_id').value;
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;

        let totalDeductions = 0;
        document.querySelectorAll('.deduction-amount').forEach(input => {
            totalDeductions += parseFloat(input.value) || 0;
        });

        const currentDeductionInput = document.querySelector('#deduction-input-row .deduction-amount-input');
        if (currentDeductionInput) {
            totalDeductions += parseFloat(currentDeductionInput.value) || 0;
        }

        if (employeeId && startDate && endDate) {
            fetch(`/api/payroll/calculate?employee_id=${employeeId}&start_date=${startDate}&end_date=${endDate}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('unitDisplay').value = data.unit || '-';
                    document.getElementById('rateDisplay').value = data.rate || '-';
                    document.getElementById('totalCell').innerText = data.total || '-';
                    document.getElementById('deductionsCell').innerText = totalDeductions ? totalDeductions.toFixed(2) : '-';
                    let gross = (parseFloat(data.gross_pay) || 0) - totalDeductions;
                    document.getElementById('grossPayCell').innerText = gross >= 0 ? gross.toFixed(2) : '-';
                });
        } else {
            document.getElementById('unitDisplay').value = '-';
            document.getElementById('rateDisplay').value = '-';
            document.getElementById('totalCell').innerText = '-';
            document.getElementById('deductionsCell').innerText = totalDeductions ? totalDeductions.toFixed(2) : '-';
            document.getElementById('grossPayCell').innerText = '-';
        }
    }

    document.getElementById('employee_id').addEventListener('change', updatePayrollTable);
    document.getElementById('start_date').addEventListener('change', updatePayrollTable);
    document.getElementById('end_date').addEventListener('change', updatePayrollTable);

    document.getElementById('addDeductionBtn').addEventListener('click', function() {
        if (document.getElementById('deduction-input-row')) {
            return;
        }

        deductionIndex++;
        const uniqueId = Date.now();

        const div = document.createElement('div');
        div.classList.add('input-group', 'mb-2');
        div.id = 'deduction-input-row';

        div.innerHTML = `
                <input type="text" class="form-control" id="deductionNameInput${uniqueId}" placeholder="Deduction Name" required>
                <input type="number" step="0.01" min="0" class="form-control deduction-amount-input" id="deductionAmountInput${uniqueId}" placeholder="Amount" required>
                <button type="button" class="btn text-success" id="saveDeductionBtn${uniqueId}" title="Save">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                    </svg>
                </button>
                <button type="button" class="btn text-danger" id="cancelDeductionBtn${uniqueId}" title="Cancel">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button>
            `;

        document.getElementById('deductions-list').appendChild(div);

        const amountInput = document.getElementById(`deductionAmountInput${uniqueId}`);
        amountInput.addEventListener('input', updatePayrollTable);

        document.getElementById(`saveDeductionBtn${uniqueId}`).addEventListener('click', function() {
            const nameInput = document.getElementById(`deductionNameInput${uniqueId}`);
            const amountInput = document.getElementById(`deductionAmountInput${uniqueId}`);

            const name = nameInput.value.trim();
            const amount = amountInput.value.trim();

            if (!name || !amount || parseFloat(amount) < 0) {
                alert('Please enter both deduction name and a valid amount.');
                return;
            }

            const staticDiv = document.createElement('div');
            staticDiv.classList.add('input-group', 'mb-2');
            staticDiv.innerHTML = `
                    <input type="hidden" name="deductions[${deductionIndex}][name]" value="${name}">
                    <input type="hidden" name="deductions[${deductionIndex}][amount]" value="${amount}" class="deduction-amount">
                    <span class="input-group-text flex-fill text-start">${name}</span>
                    <span class="input-group-text" style="min-width: 80px;">$${parseFloat(amount).toFixed(2)}</span>
                    <button type="button" class="btn btn-outline-danger remove-deduction" title="Remove">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                `;

            staticDiv.querySelector('.remove-deduction').addEventListener('click', function() {
                staticDiv.remove();
                updatePayrollTable();
            });

            div.remove();
            document.getElementById('deductions-list').appendChild(staticDiv);
            updatePayrollTable();
        });

        document.getElementById(`cancelDeductionBtn${uniqueId}`).addEventListener('click', function() {
            div.remove();
            updatePayrollTable();
        });

        document.getElementById(`deductionNameInput${uniqueId}`).focus();
    });



    updatePayrollTable();
</script>
