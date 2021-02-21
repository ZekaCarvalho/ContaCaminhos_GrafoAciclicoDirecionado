<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContadorController extends AbstractController
{
    /**
     * @Route("/contar-caminhos", name="contador")
     */
    public function main_contador(Request $request): Response
    {
        $grafo = $request->query->get('g');
        $qtdDeCaminhos = $this->conta_caminhos($grafo, 0, count($grafo) - 1);
        return $this->render('contador/index.html.twig', [ "qtdCaminhos" => $qtdDeCaminhos ]);
    } 

    private function conta_caminhos($grafo, $noInicial, $noFinal){
        $qtd_caminhos = 0;
        
        if($noInicial == $noFinal) return 1;
        
        for($vertice = 0; $vertice < count($grafo); $vertice++)
            // Verifica se existe caminho para o próximo vértice,
            // do contrário faz o backtracking.
            if ($grafo[$noInicial][$vertice] == 1)
                $qtd_caminhos += $this->conta_caminhos($grafo, $vertice, $noFinal);
        
        return $qtd_caminhos;
    }
}

//g[]=01101&g[]=00011&g[]=00001&g[]=00100&g[]=01101

