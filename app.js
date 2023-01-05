const addRecordBtn = document.querySelector('#addRecordBtn');
const modalBg = document.querySelector('.modal-bg');
const modalCloseBtn = document.querySelector('.modalCloseBtn');

const editRecordBtn = document.querySelectorAll('.editModalBtn');
const editSubmitBtn = document.querySelectorAll('.editSubmitBtn');
const editModalBg = document.querySelector('.edit-modal-bg');
const editModalCloseBtn = document.querySelectorAll('.editModalCloseBtn');

const deleteRecordBtn = document.querySelectorAll('.deleteModalBtn');
const deleteRecordSubmitBtn = document.querySelectorAll('.deleteRecordSubmitBtn');
const deleteModalBg = document.querySelector('.delete-modal-bg');
const deleteModalCloseBtn = document.querySelectorAll('.deleteModalCloseBtn');
const deleteModalCancelBtn = document.querySelectorAll('.deleteModalCancelBtn');

const searchInput = document.getElementById('search');

const tableHead = document.getElementById('table-head');
const tableBody = document.getElementById('table-data');
let tableBodyContents = tableBody.innerHTML;

addRecordBtn.addEventListener('click', () => {
  modalBg.classList.add('modal-activate');
})

modalCloseBtn.addEventListener('click', () => {
  modalBg.classList.remove('modal-activate');
})

const openEditModal = event => {

  const parentEl = event.target.parentNode.parentNode;

    parentEl.id = 'active';

    const empId = parentEl.querySelector('.emp-id').innerText;
    const empLastName = parentEl.querySelector('.emp-lastname').innerText;
    const empFirstName = parentEl.querySelector('.emp-firstname').innerText;
    const empMiddleName = parentEl.querySelector('.emp-middlename').innerText;
    const empSexId = parentEl.querySelector('.emp-sexid').innerText;
    const empAddress = parentEl.querySelector('.emp-address').innerText;
    const empPositionId = parentEl.querySelector('.emp-position').dataset.rankId;
    const empPosition = parentEl.querySelector('.emp-position').innerText;

    // console.log('empSexId', empSexId);

    const editPosSelect = document.getElementById('edit-employee-position');

    for (let i = 0; i < editPosSelect.options.length; i++) {
      const option = editPosSelect.options[i];

      if (option.value == empPositionId) {
        option.selected = true;
      } else {
        option.selected = false;
      }
    }

    editModalBg.classList.add('modal-activate');

    editModalBg.querySelector('#edit_last_name').value = empLastName;
    editModalBg.querySelector('#edit_first_name').value = empFirstName;
    editModalBg.querySelector('#edit_middle_name').value = empMiddleName;


    if(empSexId == 'Male') {
      editModalBg.querySelector('#edit_male').checked = true;
    } else {
      editModalBg.querySelector('#edit_female').checked = true;
    }

    editModalBg.querySelector('#edit_address').value = empAddress;

    const datasetId = event.target.dataset.empId;
    editModalBg.querySelector('.hiddenId').value = datasetId;
}

const editRecordSubmit = event => {
  event.preventDefault();
    
  const parentEl = event.target.parentNode;
  const empId = parentEl.querySelector('.hiddenId').value;
  const empLastName = parentEl.querySelector('#edit_last_name').value;
  const empFirstName = parentEl.querySelector('#edit_first_name').value;
  const empMiddleName = parentEl.querySelector('#edit_middle_name').value;
  const empSexId = parentEl.querySelector('input[name="edit_sex"]:checked').value;
  const empSexLabel = parentEl.querySelector('input[name="edit_sex"]:checked').dataset.sexLabel;
  const empAddress = parentEl.querySelector('#edit_address').value;
  const empPosId = parentEl.querySelector('#edit-employee-position').value;
  const empPosText = parentEl.querySelector('#edit-employee-position').querySelector('option:checked').text;
  const empPosSalary = parentEl.querySelector('#edit-employee-position').querySelector('option:checked').dataset.salary;

  axios.post('controller/update_record.php', {
    empId: empId,
    empLastName: empLastName,
    empFirstName: empFirstName,
    empMiddleName: empMiddleName,
    empSexId: empSexId,
    empAddress: empAddress,
    empPosId: empPosId
  })
  .then(function (response) {

    const activeRow = document.getElementById('active');

    activeRow.querySelector('.emp-id').innerText = empId;
    activeRow.querySelector('.emp-lastname').innerText = empLastName;
    activeRow.querySelector('.emp-firstname').innerText = empFirstName;
    activeRow.querySelector('.emp-middlename').innerText = empMiddleName;
    activeRow.querySelector('.emp-sexid').innerText = empSexLabel;
    activeRow.querySelector('.emp-address').innerText = empAddress;
    activeRow.querySelector('.emp-position').dataset.rankId = empPosId;
    activeRow.querySelector('.emp-position').innerText = empPosText;

    activeRow.querySelector('.emp-salary').innerText = Number(empPosSalary).toLocaleString();

    activeRow.classList.add('bg-green-200');

    document.getElementById('active').removeAttribute('id');      
    // document.querySelector('.alert-update-success').classList.remove('hidden');

    setTimeout(() => {
      // document.querySelector('.alert-update-success').classList.add('hidden');
      activeRow.classList.remove('bg-green-200');
    }, 3000)

    editModalBg.classList.remove('modal-activate');
  })
  .catch(function (error) {
    console.log(error);
  });
}

// editRecordBtn.forEach(editBtn => {
//   editBtn.addEventListener('click', () => {

//     const parentEl = editBtn.parentNode.parentNode;

//     parentEl.id = 'active';

//     const empId = parentEl.querySelector('.emp-id').innerText;
//     const empLastName = parentEl.querySelector('.emp-lastname').innerText;
//     const empFirstName = parentEl.querySelector('.emp-firstname').innerText;
//     const empMiddleName = parentEl.querySelector('.emp-middlename').innerText;
//     const empSexId = parentEl.querySelector('.emp-sexid').innerText;
//     const empAddress = parentEl.querySelector('.emp-address').innerText;
//     const empPositionId = parentEl.querySelector('.emp-position').dataset.rankId;
//     const empPosition = parentEl.querySelector('.emp-position').innerText;

//     // console.log('empSexId', empSexId);

//     const editPosSelect = document.getElementById('edit-employee-position');

//     for (let i = 0; i < editPosSelect.options.length; i++) {
//       const option = editPosSelect.options[i];

//       if (option.value == empPositionId) {
//         option.selected = true;
//       } else {
//         option.selected = false;
//       }
//     }

//     editModalBg.classList.add('modal-activate');

//     editModalBg.querySelector('#edit_last_name').value = empLastName;
//     editModalBg.querySelector('#edit_first_name').value = empFirstName;
//     editModalBg.querySelector('#edit_middle_name').value = empMiddleName;


//     if(empSexId == 'Male') {
//       editModalBg.querySelector('#edit_male').checked = true;
//     } else {
//       editModalBg.querySelector('#edit_female').checked = true;
//     }

//     editModalBg.querySelector('#edit_address').value = empAddress;

//     const datasetId = editBtn.dataset.empId;
//     editModalBg.querySelector('.hiddenId').value = datasetId;
//   })
// })

// editSubmitBtn.forEach(editSubmit => {
  
//   editSubmit.addEventListener('click', (event) => {

//     event.preventDefault();
    
//     const parentEl = editSubmit.parentNode;
//     const empId = parentEl.querySelector('.hiddenId').value;
//     const empLastName = parentEl.querySelector('#edit_last_name').value;
//     const empFirstName = parentEl.querySelector('#edit_first_name').value;
//     const empMiddleName = parentEl.querySelector('#edit_middle_name').value;
//     const empSexId = parentEl.querySelector('input[name="edit_sex"]:checked').value;
//     const empSexLabel = parentEl.querySelector('input[name="edit_sex"]:checked').dataset.sexLabel;
//     const empAddress = parentEl.querySelector('#edit_address').value;
//     const empPosId = parentEl.querySelector('#edit-employee-position').value;
//     const empPosText = parentEl.querySelector('#edit-employee-position').querySelector('option:checked').text;
//     const empPosSalary = parentEl.querySelector('#edit-employee-position').querySelector('option:checked').dataset.salary;

//     axios.post('controller/update_record.php', {
//       empId: empId,
//       empLastName: empLastName,
//       empFirstName: empFirstName,
//       empMiddleName: empMiddleName,
//       empSexId: empSexId,
//       empAddress: empAddress,
//       empPosId: empPosId
//     })
//     .then(function (response) {

//       const activeRow = document.getElementById('active');

//       activeRow.querySelector('.emp-id').innerText = empId;
//       activeRow.querySelector('.emp-lastname').innerText = empLastName;
//       activeRow.querySelector('.emp-firstname').innerText = empFirstName;
//       activeRow.querySelector('.emp-middlename').innerText = empMiddleName;
//       activeRow.querySelector('.emp-sexid').innerText = empSexLabel;
//       activeRow.querySelector('.emp-address').innerText = empAddress;
//       activeRow.querySelector('.emp-position').dataset.rankId = empPosId;
//       activeRow.querySelector('.emp-position').innerText = empPosText;

//       activeRow.querySelector('.emp-salary').innerText = Number(empPosSalary).toLocaleString();

//       activeRow.classList.add('bg-green-200');

//       document.getElementById('active').removeAttribute('id');      
//       // document.querySelector('.alert-update-success').classList.remove('hidden');

//       setTimeout(() => {
//         // document.querySelector('.alert-update-success').classList.add('hidden');
//         activeRow.classList.remove('bg-green-200');
//       }, 3000)

//       editModalBg.classList.remove('modal-activate');
//     })
//     .catch(function (error) {
//       console.log(error);
//     });
//   })

// })

editModalCloseBtn.forEach(editCloseBtn => {
  editCloseBtn.addEventListener('click', () => {
    editModalBg.classList.remove('modal-activate');
    document.getElementById('active').removeAttribute('id');
  })
})


const openDeleteModal = event => {
  deleteModalBg.classList.add('modal-activate');
    const parentEl = event.target.parentNode.parentNode

    parentEl.id = 'active';
}

const deleteRecordSubmit = event => {
  deleteModalBg.classList.add('modal-activate');

    event.preventDefault();

    const activeRow = document.getElementById('active');
    const empId = activeRow.querySelector('.emp-id').innerText;

    axios.post('controller/delete_record.php', {
      empId: empId
    })
    .then(response => {

      document.getElementById('active').removeAttribute('id');      
      // document.querySelector('.alert-delete-success').classList.remove('hidden');
      activeRow.classList.add('bg-red-200');
      
      tableBodyContents = '';

      response.data.forEach(empData => {
        tableBodyContents += 
                `<tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                    <td class="emp-id py-4 px-6 hidden">
                        ${empData['id']}
                    </td>
                    <td class="emp-lastname py-4 px-6">
                        ${empData['last_name']}
                    </td>
                    <td class="emp-firstname py-4 px-6">
                        ${empData['first_name']}
                    </td>
                    <td class="emp-middlename py-4 px-6">
                        ${empData['middle_name']}
                    </td>
                    <td class="emp-sexid py-4 px-6">
                        ${empData['gender']}
                    </td>
                    <td class="emp-address py-4 px-6">
                        ${empData['address']}
                    </td>
                    <td data-rank-id="${empData['rank_id']}" class="emp-position py-4 px-6">
                        ${empData['position']}
                    </td>
                    <td class="emp-salary py-4 px-6">
                        ${Number(empData['salary']).toLocaleString()}
                    </td>
                    <td class="emp- w-1/4 py-4 px-6 sm:flex-col justify-between md:flex flex-row justify-between">
                        <button onclick="openEditModal(event)" data-emp-id="${empData['id']}" class="editModalBtn font-medium text-blue-600 dark:text-blue-500 hover:underline" >Edit</button>
                        <button onclick="openDeleteModal(event)" class="deleteModalBtn font-medium text-red-600 dark:text-blue-500 hover:underline">Delete</button>
                    </td>
                  </tr>`;
      });

      setTimeout(() => {
        activeRow.classList.remove('bg-red-200');
        tableBody.removeChild(activeRow);
        tableBody.innerHTML = tableBodyContents;

        // tableBody.innerHTML = tableBodyContents;

      }, 1000);

      // setTimeout(() => {
      //   document.querySelector('.alert-delete-success').classList.add('hidden');
      // }, 3000)

      deleteModalBg.classList.remove('modal-activate');

    })
    .catch(error => {
      console.log(error);
    })
}

// deleteRecordBtn.forEach(deleteBtn => {
//   deleteBtn.addEventListener('click', () => {
//     deleteModalBg.classList.add('modal-activate');
//     const parentEl = deleteBtn.parentNode.parentNode
//     parentEl.id = 'active';
//   })
// })

// deleteRecordSubmitBtn.forEach(deleteRecordSubmit => {
//   deleteRecordSubmit.addEventListener('click', event => {

//     event.preventDefault();

//     const activeRow = document.getElementById('active');
//     const empId = activeRow.querySelector('.emp-id').innerText;


//     axios.post('controller/delete_record.php', {
//       empId: empId
//     })
//     .then(response => {
//       console.log(response);

//       document.getElementById('active').removeAttribute('id');      
//       // document.querySelector('.alert-delete-success').classList.remove('hidden');
//       activeRow.classList.add('bg-red-200');

//       setTimeout(() => {
//         activeRow.classList.remove('bg-red-200');
//         tableBody.removeChild(activeRow);
//       }, 1000);

//       // setTimeout(() => {
//       //   document.querySelector('.alert-delete-success').classList.add('hidden');
//       // }, 3000)

//       deleteModalBg.classList.remove('modal-activate');

//     })
//     .catch(error => {
//       console.log(error);
//     })
//   })
// })

deleteModalCloseBtn.forEach(deleteCloseBtn => {
  deleteCloseBtn.addEventListener('click', () => {
    deleteModalBg.classList.remove('modal-activate');
  })
})

deleteModalCancelBtn.forEach(deleteCancelBtn => {
  deleteCancelBtn.addEventListener('click', () => {
    deleteModalBg.classList.remove('modal-activate');
  })
})



// search
searchInput.addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
    
    const searchStr = searchInput.value.toLowerCase().trim();

    // axios.get('/controller/search.php', )

    if(searchStr !== '') {

      axios.get('controller/search.php?searchStr='+searchStr)
      .then(res => {
          
          if(res.data.length > 0) {

            tableBody.innerHTML = '';

            res.data.forEach(tblData => {
              tableBody.innerHTML += 
              `<tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                  <td class="emp-id py-4 px-6 hidden">
                      ${tblData['id']}
                  </td>
                  <td class="emp-lastname py-4 px-6">
                      ${tblData['last_name']}
                  </td>
                  <td class="emp-firstname py-4 px-6">
                      ${tblData['first_name']}
                  </td>
                  <td class="emp-middlename py-4 px-6">
                      ${tblData['middle_name']}
                  </td>
                  <td class="emp-sexid py-4 px-6">
                      ${tblData['gender']}
                  </td>
                  <td class="emp-address py-4 px-6">
                      ${tblData['address']}
                  </td>
                  <td data-rank-id="${tblData['rank_id']}" class="emp-position py-4 px-6">
                      ${tblData['position']}
                  </td>
                  <td class="emp-salary py-4 px-6">
                      ${Number(tblData['salary']).toLocaleString()}
                  </td>
                  <td class="emp- w-1/4 py-4 px-6 sm:flex-col justify-between md:flex flex-row justify-between">
                      <button onclick="openEditModal(event)" data-emp-id="${tblData['id']}" class="editModalBtn font-medium text-blue-600 dark:text-blue-500 hover:underline" >Edit</button>
                      <button onclick="openDeleteModal(event)" class="deleteModalBtn font-medium text-red-600 dark:text-blue-500 hover:underline">Delete</button>
                  </td>
                </tr>`;
            });

          } else {
            tableBody.innerHTML = 
              `<tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                <td colspan="${tableHead.querySelectorAll('th').length}" class="py-4 px-6 text-center">
                    No Data Available
                </td>
              </tr>`
          }

      })
      .catch(err => {
          console.error(err);
      });
    } else {
      tableBody.innerHTML = tableBodyContents;
    }
  }
});

searchInput.addEventListener('blur', event => {
  const searchStr = searchInput.value.toLowerCase().trim();
  if(searchStr == '') {
    tableBody.innerHTML = tableBodyContents;
  }
})