<?php 

namespace Interne\SeanceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\FOSRestController;


use Interne\SeanceBundle\Entity\Meeting;

/**
 * REST Controller for managing exportable Entities
 *
 */
class ExportController extends FOSRestController
{

    // ========================================================
    //                     REST ACTIONS
    // ========================================================

    /**
     * Generate a PDF for a given Meeting entity
     */
    public function exportToPDFAction(Meeting $meeting) {
    	$html = $this->render("InterneSeanceBundle:Export:pdf_export.html.twig", ["meeting" => $meeting])->getContent();

        $html2pdf = $this->get('html2pdf_factory')->create();
        $html2pdf->WriteHTML($html);
        $html2pdf->pdf->SetTitle($meeting->getName());
        $file = $html2pdf->Output("export_". strtolower($meeting->getName()) . ".pdf", "D");
        
    }
}