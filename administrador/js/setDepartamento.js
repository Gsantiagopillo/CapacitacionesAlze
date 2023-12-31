import api from "../../helpers/app.js";
import { helpHttp } from "../../helpers/helpHttp.js";

const d = document;

const { DOMAIN, EMPRESAS, DEPTOS, USUARIOS } = api;

export default async function setDepartamento(e, id = null) {
  if (
    !location.pathname.includes("/registrarUsuario.html") &&
    !location.pathname.includes("/editarUsuario.html") &&
    !location.pathname.includes("/registrarEstudiante.html") &&
    !location.pathname.includes("/AsignarCurso.html")
  )
    return;

  let evento = e !== null ? e.target : null;

  if (evento === null && id === null) return;

  if (evento !== null) {
    if (!evento.matches("#empresa")) return;
  }

  let departamentos = await helpHttp().post(`${DEPTOS}getDepartamentos.php`);

  const idEmpresa = id || e.target.value;

  departamentos = departamentos.filter(
    (depto) => depto["id_empresa"] === idEmpresa
  );

  const $form =
    d.getElementById("form-create-user") ||
    d.getElementById("form-edit-user") ||
    d.getElementById("form-create-student") ||
    d.getElementById("form-assign-course");

  const $select = $form.departamento;

  while ($select.options.length > 1) {
    $select.removeChild($select.lastChild);
  }

  $select.options[0].selected = true;
  const $fragmento = document.createDocumentFragment();

  departamentos.forEach((el) => {
    const $opcion = d.createElement("option");
    $opcion.textContent = el.nombre;
    $opcion.value = el.id;
    $fragmento.appendChild($opcion);
  });

  $select.appendChild($fragmento);
  // console.log($select);
  let elems = document.querySelectorAll("select");
  let instances = M.FormSelect.init(elems);
}
