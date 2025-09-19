<link rel="stylesheet" type="text/css" href="../librerias/bootstrap/css/bootstrap.css">

<script src="../librerias/bootstrap/js/jquery-3.3.1.min.js"></script>
<script src="../librerias/bootstrap/js/bootstrap.js"></script>
<style>
/* Estilos para el body y elementos de texto */
body {
  background-color: #000000;
  color: #c7f3ff;
  font-family: 'Consolas', 'Courier New', monospace;
}

h1, h2, h3, h4, h5, h6 {
  color: #00ffff;
  text-shadow: 0 0 10px #00ffff;
  text-transform: uppercase;
  letter-spacing: 3px;
  border-bottom: 2px solid #00ffff;
  padding-bottom: 5px;
  display: inline-block;
}

p {
  color: #8899aa;
  line-height: 1.6;
}

/* Estilos de la tabla */
table {
  width: 100%;
  border-collapse: collapse;
  background-color: #0c1a2c;
  color: #00ffff;
  box-shadow: 0 0 15px rgba(0, 255, 255, 0.5);
}

th, td {
  padding: 12px 15px;
  text-align: left;
  border-bottom: 1px solid #00ffff;
}

thead th {
  background-color: #1a2c3d;
  text-transform: uppercase;
  letter-spacing: 2px;
  font-size: 1.1em;
  text-shadow: 0 0 5px #00ffff;
}

tbody tr:nth-child(even) {
  background-color: #12243a;
}

tbody tr:hover {
  background-color: #213a50;
  cursor: pointer;
}

.btn {
  background-color: #00ffff !important;
  color: #0c1a2c !important;
  border: none;
  border-radius: 2px;
  box-shadow: 0 0 8px rgba(0, 255, 255, 0.7);
  transition: all 0.3s ease;
}

.btn:hover {
  background-color: #00e0e0 !important;
  box-shadow: 0 0 12px rgba(0, 255, 255, 0.9);
}

/* Estilos para el modal */
.modal-content {
  background-color: #0c1a2c;
  color: #00ffff;
  border: 1px solid #00ffff;
  box-shadow: 0 0 20px rgba(0, 255, 255, 0.7);
}

.modal-header {
  border-bottom: 1px solid #00ffff;
  text-shadow: 0 0 5px #00ffff;
}

.modal-title {
  color: #00ffff;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.close {
  color: #00ffff;
  text-shadow: 0 0 5px #00ffff;
}

.modal-body {
    display: flex;
    flex-direction: column;
    gap: 15px; /* Adds space between form elements */
    padding: 20px;
}

.modal-body label {
  color: #c7f3ff;
  font-weight: normal;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.form-control {
  background-color: #1a2c3d;
  border: 1px solid #00ffff;
  color: #fff;
  font-family: 'Consolas', monospace;
  box-shadow: inset 0 0 5px rgba(0, 255, 255, 0.3);
  width: 100%; /* Ensures inputs take full width of their container */
  box-sizing: border-box; /* Includes padding and border in the element's total width and height */
}

.form-control:focus {
  border-color: #00e0e0;
  box-shadow: inset 0 0 8px rgba(0, 255, 255, 0.5);
}

.btn-primary {
  background-color: #00ffff !important;
  color: #0c1a2c !important;
  border: none;
  box-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
  transition: all 0.3s ease;
}

.btn-primary:hover {
  background-color: #00e0e0 !important;
  box-shadow: 0 0 15px rgba(0, 255, 255, 0.9);
}

.form-control:disabled, .form-control[disabled] {
    background-color: #0c1a2c;
    color: #ffffff;
    border: 1px solid #005f5f;
    box-shadow: none;
    cursor: not-allowed;
}

#pedido-table {
    width: 100%;
}

#pedido-table td {
    padding: 0 5px; /* Reduces padding to fit more elements */
}

#pedido-table select {
    width: 100%;
    box-sizing: border-box;
}

#add-row {
    margin-top: 10px;
}

/* Estilos de paginación */
.pagination {
  display: flex;
  padding-left: 0;
  list-style: none;
  border-radius: .25rem;
  justify-content: center;
  margin-top: 20px;
  box-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
}

.page-item .page-link {
  position: relative;
  display: block;
  padding: .5rem .75rem;
  margin-left: -1px;
  line-height: 1.25;
  color: #00ffff;
  background-color: #0c1a2c;
  border: 1px solid #00ffff;
  font-family: 'Consolas', 'Courier New', monospace;
  transition: all 0.3s ease;
}

.page-item.active .page-link {
  z-index: 1;
  color: #0c1a2c;
  background-color: #00ffff;
  border-color: #00ffff;
  box-shadow: 0 0 8px rgba(0, 255, 255, 0.9);
}

.page-item .page-link:hover {
  background-color: #00e0e0;
  color: #0c1a2c;
}

.page-item.disabled .page-link {
  color: #6c757d;
  pointer-events: none;
  cursor: default;
  background-color: #0c1a2c;
  border-color: #005f5f;
  text-shadow: none;
  box-shadow: none;
}
</style>