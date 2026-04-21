const STORAGE_KEY = 'robuxradit-inventaris-p1';

const defaultInventory = [
  {
    kodeBarang: 'BRG-001',
    namaBarang: 'Gamepass Starter',
    kategori: 'Gamepass',
    stok: 12,
    harga: 35000,
    tanggalMasuk: '2026-04-10'
  },
  {
    kodeBarang: 'BRG-002',
    namaBarang: 'Voucher Robux 400',
    kategori: 'Voucher',
    stok: 4,
    harga: 79000,
    tanggalMasuk: '2026-04-11'
  },
  {
    kodeBarang: 'BRG-003',
    namaBarang: 'Private Server Sailor piece',
    kategori: 'Private Server',
    stok: 7,
    harga: 129000,
    tanggalMasuk: '2026-04-12'
  },
];

let inventory = [];
let currentEditIndex = null;

const form = document.getElementById('inventoryForm');
const tbody = document.getElementById('inventoryTableBody');
const searchInput = document.getElementById('searchInput');
const filterKategori = document.getElementById('filterKategori');
const submitButton = document.getElementById('submitButton');
const cancelEditButton = document.getElementById('cancelEditButton');
const formStatus = document.getElementById('formStatus');

const fieldIds = ['kodeBarang', 'namaBarang', 'kategori', 'stok', 'harga', 'tanggalMasuk'];

const escapeHtml = (value) => String(value)
  .replaceAll('&', '&amp;')
  .replaceAll('<', '&lt;')
  .replaceAll('>', '&gt;')
  .replaceAll('"', '&quot;')
  .replaceAll("'", '&#39;');

const formatCurrency = (value) => new Intl.NumberFormat('id-ID', {
  style: 'currency',
  currency: 'IDR',
  maximumFractionDigits: 0
}).format(value);

const formatDate = (value) => {
  const date = new Date(value);
  if (Number.isNaN(date.getTime())) return '-';
  return date.toLocaleDateString('id-ID', {
    day: '2-digit',
    month: 'long',
    year: 'numeric'
  });
};

const saveToLocalStorage = () => {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(inventory));
};

const loadFromLocalStorage = () => {
  const savedData = localStorage.getItem(STORAGE_KEY);
  if (!savedData) {
    inventory = [...defaultInventory];
    saveToLocalStorage();
    return;
  }

  try {
    const parsed = JSON.parse(savedData);
    inventory = Array.isArray(parsed) ? parsed : [...defaultInventory];
  } catch (error) {
    inventory = [...defaultInventory];
    saveToLocalStorage();
  }
};

const setStatusMessage = (message = '', type = '') => {
  formStatus.textContent = message;
  formStatus.className = 'status-box';
  if (message && type) {
    formStatus.classList.add(type);
  }
};

const getFieldElement = (fieldId) => document.getElementById(fieldId);
const getErrorElement = (fieldId) => document.getElementById(`error-${fieldId}`);

const showFieldError = (fieldId, message) => {
  const field = getFieldElement(fieldId);
  const error = getErrorElement(fieldId);
  field.classList.add('input-error');
  field.classList.remove('input-valid');
  error.textContent = message;
};

const clearFieldError = (fieldId) => {
  const field = getFieldElement(fieldId);
  const error = getErrorElement(fieldId);
  field.classList.remove('input-error');
  field.classList.add('input-valid');
  error.textContent = '';
};

const findDuplicateCode = (code) => inventory.findIndex((item, index) =>
  item.kodeBarang.toLowerCase() === code.toLowerCase() && index !== currentEditIndex
);

const validateField = (fieldId) => {
  const field = getFieldElement(fieldId);
  const rawValue = field.value.trim();
  let message = '';

  if (fieldId === 'kodeBarang') {
    const pattern = /^[A-Za-z0-9-]{4,15}$/;
    if (!rawValue) {
      message = 'Kode barang wajib diisi.';
    } else if (!pattern.test(rawValue)) {
      message = 'Kode barang harus 4-15 karakter (huruf, angka, atau tanda hubung).';
    } else if (findDuplicateCode(rawValue) !== -1) {
      message = 'Kode barang sudah digunakan. Gunakan kode lain.';
    }
  }

  if (fieldId === 'namaBarang') {
    if (!rawValue) {
      message = 'Nama barang wajib diisi.';
    } else if (rawValue.length < 3) {
      message = 'Nama barang minimal 3 karakter.';
    }
  }

  if (fieldId === 'kategori') {
    if (!rawValue) {
      message = 'Kategori wajib dipilih.';
    }
  }

  if (fieldId === 'stok') {
    const stok = Number(rawValue);
    if (!rawValue) {
      message = 'Stok wajib diisi.';
    } else if (!Number.isInteger(stok) || stok < 0) {
      message = 'Stok harus berupa angka bulat 0 atau lebih.';
    }
  }

  if (fieldId === 'harga') {
    const harga = Number(rawValue);
    if (!rawValue) {
      message = 'Harga wajib diisi.';
    } else if (Number.isNaN(harga) || harga <= 0) {
      message = 'Harga harus lebih besar dari 0.';
    }
  }

  if (fieldId === 'tanggalMasuk') {
    if (!rawValue) {
      message = 'Tanggal masuk wajib diisi.';
    } else {
      const inputDate = new Date(rawValue);
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      if (inputDate > today) {
        message = 'Tanggal masuk tidak boleh melebihi hari ini.';
      }
    }
  }

  if (message) {
    showFieldError(fieldId, message);
    return false;
  }

  clearFieldError(fieldId);
  return true;
};

const validateForm = () => fieldIds.every((fieldId) => validateField(fieldId));

const getFormData = () => ({
  kodeBarang: getFieldElement('kodeBarang').value.trim().toUpperCase(),
  namaBarang: getFieldElement('namaBarang').value.trim(),
  kategori: getFieldElement('kategori').value,
  stok: Number(getFieldElement('stok').value),
  harga: Number(getFieldElement('harga').value),
  tanggalMasuk: getFieldElement('tanggalMasuk').value
});

const resetFormState = (clearStatus = true) => {
  form.reset();
  currentEditIndex = null;
  submitButton.textContent = 'Tambah Barang';
  cancelEditButton.style.display = 'none';
  if (clearStatus) {
    setStatusMessage();
  }
  fieldIds.forEach((fieldId) => {
    getFieldElement(fieldId).classList.remove('input-error', 'input-valid');
    getErrorElement(fieldId).textContent = '';
  });
};

const updateStatistics = () => {
  const totalBarang = inventory.length;
  const totalStok = inventory.reduce((total, item) => total + item.stok, 0);
  const totalNilai = inventory.reduce((total, item) => total + (item.stok * item.harga), 0);
  const stokMenipis = inventory.filter((item) => item.stok < 5).length;

  document.getElementById('statTotalBarang').textContent = totalBarang;
  document.getElementById('statTotalStok').textContent = totalStok;
  document.getElementById('statTotalNilai').textContent = formatCurrency(totalNilai);
  document.getElementById('statStokMenipis').textContent = stokMenipis;
};

const getFilteredInventory = () => {
  const keyword = searchInput.value.trim().toLowerCase();
  const kategoriAktif = filterKategori.value;

  return inventory.filter((item) => {
    const matchesKeyword =
      item.kodeBarang.toLowerCase().includes(keyword) ||
      item.namaBarang.toLowerCase().includes(keyword);

    const matchesKategori =
      kategoriAktif === 'Semua' || item.kategori === kategoriAktif;

    return matchesKeyword && matchesKategori;
  });
};

const renderTable = () => {
  const filteredInventory = getFilteredInventory();

  if (filteredInventory.length === 0) {
    tbody.innerHTML = `
      <tr>
        <td colspan="9" class="empty-state">
          Data tidak ditemukan. Ubah kata kunci pencarian atau kategori filter.
        </td>
      </tr>
    `;
    return;
  }

  tbody.innerHTML = filteredInventory.map((item, index) => {
    const originalIndex = inventory.findIndex((inventoryItem) => inventoryItem.kodeBarang === item.kodeBarang);
    const stokClass = item.stok < 5 ? 'badge badge-low' : 'badge badge-safe';
    const stokText = item.stok < 5 ? 'Menipis' : 'Aman';

    return `
      <tr data-index="${originalIndex}">
        <td>${index + 1}</td>
        <td>${escapeHtml(item.kodeBarang)}</td>
        <td>${escapeHtml(item.namaBarang)}</td>
        <td>${escapeHtml(item.kategori)}</td>
        <td>${item.stok}</td>
        <td>${formatCurrency(item.harga)}</td>
        <td>${formatDate(item.tanggalMasuk)}</td>
        <td><span class="${stokClass}">${stokText}</span></td>
        <td>
          <div class="action-group">
            <button type="button" class="action-btn edit" data-action="edit" data-index="${originalIndex}">Edit</button>
            <button type="button" class="action-btn delete" data-action="delete" data-index="${originalIndex}">Hapus</button>
          </div>
        </td>
      </tr>
    `;
  }).join('');
};

const syncView = () => {
  saveToLocalStorage();
  renderTable();
  updateStatistics();
};

const fillFormForEdit = (index) => {
  const item = inventory[index];
  if (!item) return;

  currentEditIndex = index;
  getFieldElement('kodeBarang').value = item.kodeBarang;
  getFieldElement('namaBarang').value = item.namaBarang;
  getFieldElement('kategori').value = item.kategori;
  getFieldElement('stok').value = item.stok;
  getFieldElement('harga').value = item.harga;
  getFieldElement('tanggalMasuk').value = item.tanggalMasuk;

  submitButton.textContent = 'Simpan Perubahan';
  setStatusMessage(`Mode edit aktif untuk barang ${item.kodeBarang}.`, 'success');
  cancelEditButton.style.display = 'inline-flex';
  window.scrollTo({ top: form.offsetTop - 110, behavior: 'smooth' });
};

const deleteItem = (index) => {
  const item = inventory[index];
  if (!item) return;

  const confirmation = confirm(`Hapus barang ${item.namaBarang} (${item.kodeBarang})?`);
  if (!confirmation) return;

  inventory.splice(index, 1);
  if (currentEditIndex === index) {
    resetFormState(false);
  }
  setStatusMessage('Data barang berhasil dihapus.', 'success');
  syncView();
};

form.addEventListener('submit', (event) => {
  event.preventDefault();

  const isValid = validateForm();
  if (!isValid) {
    setStatusMessage('Periksa kembali form. Masih ada data yang belum valid.', 'error');
    return;
  }

  const formData = getFormData();

  if (currentEditIndex !== null) {
    inventory[currentEditIndex] = formData;
    syncView();
    resetFormState(false);
    setStatusMessage('Data barang berhasil diperbarui.', 'success');
  } else {
    inventory.push(formData);
    syncView();
    resetFormState(false);
    setStatusMessage('Data barang berhasil ditambahkan.', 'success');
  }
});

cancelEditButton.addEventListener('click', () => {
  resetFormState(false);
  setStatusMessage('Mode edit dibatalkan.', 'success');
});

fieldIds.forEach((fieldId) => {
  const field = getFieldElement(fieldId);
  field.addEventListener('blur', () => validateField(fieldId));
  field.addEventListener('input', () => {
    if (field.classList.contains('input-error')) {
      validateField(fieldId);
    }
  });
});

searchInput.addEventListener('input', renderTable);
filterKategori.addEventListener('change', renderTable);

tbody.addEventListener('click', (event) => {
  const button = event.target.closest('button[data-action]');
  const row = event.target.closest('tr');

  tbody.querySelectorAll('tr').forEach((tableRow) => tableRow.classList.remove('row-selected'));
  if (row) {
    row.classList.add('row-selected');
  }

  if (!button) return;

  const index = Number(button.dataset.index);
  const action = button.dataset.action;

  if (action === 'edit') {
    fillFormForEdit(index);
  }

  if (action === 'delete') {
    deleteItem(index);
  }
});

document.addEventListener('DOMContentLoaded', () => {
  loadFromLocalStorage();
  syncView();
  cancelEditButton.style.display = 'none';
});
