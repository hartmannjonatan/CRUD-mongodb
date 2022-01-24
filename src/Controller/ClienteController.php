<?php

namespace App\Controller;

use App\Form\Type\ClienteType;
use App\Form\Type\ClienteTypeEdit;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\Cliente;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClienteController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function read(DocumentManager $dm)
    {
        $clientes = $dm->getRepository(Cliente::class)->findAll();
        
        return $this->render('cliente.html.twig', [
            'clientes' => $clientes
        ]);
    }

    #[Route('/create', name: 'cliente-create')]
    public function create(Request $request, DocumentManager $dm): Response {

        $cliente = new Cliente();

        $form = $this->createForm(ClienteType::class, $cliente);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $telefone = str_replace(['(', ')', ' ', '-'], ['', '', '', ''], $form->get('telefone')->getData());
            
            $cliente->setTelefone($telefone);

            if(!$form->get('notif_whats')->getData()){
                $cliente->setNotifWhats(false);
            } 

            if(!$form->get('emails_promocionais')->getData()){
                $cliente->setEmailsPromocionais(false);
            } 

            $dm->persist($cliente);

            $cliente = $form->getData();
           
            $dm->persist($cliente);
            $dm->flush();
            
            $this->addFlash(
                'success',
                'Cliente cadastrado com sucesso!'
            );
            
            return $this->redirectToRoute('home');
        }

        return $this->renderForm('criarCliente.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/update/{id}', name: 'cliente-update')]
    public function update(string $id, Request $request, DocumentManager $dm): Response {
        $cliente = $dm->getRepository(Cliente::class)->find($id);

        if(!$cliente){
            $this->addFlash(
                'error',
                'Esse cliente não existe. :('
            );
            
            return $this->redirectToRoute('home');
        }

        $form = $this->createForm(ClienteTypeEdit::class, $cliente);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $telefone = str_replace(['(', ')', ' ', '-'], ['', '', '', ''], $form->get('telefone')->getData());
            
            $cliente->setTelefone($telefone);

            if(!$form->get('notif_whats')->getData()){
                $cliente->setNotifWhats(false);
            } 

            if(!$form->get('emails_promocionais')->getData()){
                $cliente->setEmailsPromocionais(false);
            } 

            $dm->persist($cliente);

            $cliente = $form->getData();
            $dm->persist($cliente);
            $dm->flush();
            

            $this->addFlash(
                'success',
                'O cliente foi editado com sucesso!'
            );
            
            return $this->redirectToRoute('home');
        }

        return $this->renderForm('editCliente.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/delete/{id}', name: 'cliente-delete')]
    public function delete(string $id, Request $request, DocumentManager $dm): Response {

        $cliente = $dm->getRepository(Cliente::class)->find($id);

        if(!$cliente){
            $this->addFlash(
                'error',
                'Esse cliente não existe. :('
            );
            
            return $this->redirectToRoute('home');
        }

            $this->addFlash(
                'success',
                'O cliente foi deletado com sucesso!'
            );

            $dm->remove($cliente);
            $dm->flush();
            
            
            return $this->redirectToRoute('home');
    }
}