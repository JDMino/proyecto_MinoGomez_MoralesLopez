<?php
namespace App\Controllers;
use App\Models\Consultas_model;
use CodeIgniter\Controller;

class Consultas_controller extends Controller {
    
    public function formValidationConsultas() {

            $input = $this->validate([
                'nombre' => 'required|min_length[3]',
                'apellido' => 'required|min_length[3]|max_length[25]',
                'email' => 'required|min_length[4]|max_length[100]|valid_email',
                'telefono' => 'required|min_length[1]',
                'mensaje' => 'required|min_length[2]|max_length[1000]',
            ]);
            
            //var_dump($input);
            //die;

            $formModel = new Consultas_model();

            if (!$input) {
                $data = ['titulo' => 'Información de Contacto'];
                        return view('front\head_view', $data).
                                view('front\nav_view').
                                view('front\contacto_view').
                                view('back\consultas\consulta_view').
                                view('front\footer_view');
            } else {
                $formModel->save([
                    'nombre' => $this->request->getVar('nombre'),
                    'apellido' => $this->request->getVar('apellido'),
                    'usuario' => $this->request->getVar('usuario'),
                    'email' => $this->request->getVar('email'),
                    'telefono' => $this->request->getVar('telefono'),
                    'mensaje' => $this->request->getVar('mensaje'),
                ]);

                session()->setFlashdata('success', 'Consulta enviada con éxito');
                return redirect()->to('/contacto');
            }
        }


        //mostrar la lista de usuarios
        public function listar_consultas() {

            $consultasModel = new Consultas_model();
            
            //realizo la consulta para mostrar todos los usuarios
            $data['consultas'] = $consultasModel->getConsultasAll();

            $dato = ['titulo' => 'Lista de Consultas'];
            return view('front\head_view', $dato).
                    view('front\nav_view').
                    view('back\consultas\listar_consultas_view', $data).
                    view('front\footer_view');
        }

        public function responder_consulta($id_consulta) {
            $consultasModel = new Consultas_model();
            $consulta = $consultasModel->find($id_consulta);

            if (!$consulta) {
                session()->setFlashdata('error', 'Consulta no encontrada.');
                return redirect()->to('/listar_consultas_admin');
            }

            $dato = ['titulo' => 'Responder consulta'];
            return view('front/head_view', $dato)
                .view('front/nav_view')
                .view('back/consultas/responder_consulta_view', ['consulta' => $consulta])
                .view('front/footer_view');
        }

        public function guardar_respuesta() {
            $consultasModel = new Consultas_model();
            $id_consulta = $this->request->getVar('id_consulta');
            $respuesta = $this->request->getVar('respuesta');

            if (!$id_consulta || !$respuesta) {
                session()->setFlashdata('error', 'Debe ingresar una respuesta.');
                return redirect()->to('/responder_consulta' . $id_consulta);
            }

            $consultasModel->responderConsulta($id_consulta, $respuesta);
            session()->setFlashdata('success', 'Respuesta guardada con éxito.');
            return redirect()->to('/listar_consultas');
        }

        public function eliminar_consulta($id_consulta) {
            $consultasModel = new Consultas_model();
            $consulta = $consultasModel->find($id_consulta);

            if (!$consulta) {
                session()->setFlashdata('error', 'Consulta no encontrada.');
                return redirect()->to('/listar_consultas_admin');
            }

            if (!empty($consulta['respuesta'])) {
                $consultasModel->actualizarEstado($id_consulta, 'CONSULTA ELIMINADA');
                session()->setFlashdata('success', 'Consulta Eliminada.');
            } else {
                session()->setFlashdata('error', 'No puedes marcar como respondida una consulta sin respuesta.');
            }

            return redirect()->to('/listar_consultas');
        }


        public function listar_consultas_eliminadas() {
        $consultasModel = new Consultas_model();

        // Filtrar solo consultas con estado "CONSULTA ELIMINADA"
        $data['consultas'] = $consultasModel->getConsultasEliminadas();
        $data['titulo'] = 'Consultas Eliminadas';

        return view('front/head_view', $data)
            .view('front/nav_view')
            .view('back/consultas/consultas_eliminadas_view', $data)
            .view('front/footer_view');
    }
}