<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DanceController extends AbstractController
{
    /**
     * @Route("/dance", name="dance")
     */
    private $root="/home/azaria/Videos";
    public function index()
    {
        return $this->render('dance/index.html.twig', [
            'controller_name' => 'DanceController',
        ]);
    }
    /**
     * @Route("/videos", name="videos")
     */
    public function getAllVideos(){

        $v=$this->retourneAllVideos([$this->root,"/home/azaria/Documents","/home/azaria/Downloads"],array());
        return $this->json(json_encode($v));

    }
    public function retourneAllVideos(array $dir_list,array $vf,array $extention=array("avi","mp4","vob")){
        $tab_dir=array();
        foreach ($dir_list as $dir){
            if(is_dir($dir)){
                $rp=opendir($dir);
                while($el=readdir($rp)){
                    if(is_dir($el))
                        $tab_dir[]=realpath($el);
                    if(is_file($el)){
                        $info = new \SplFileInfo($el);
                        $ex=$info->getExtension();
                        if(in_array($ex,$extention))
                            $vf[]=realpath($el);
                    }
                }
            }
            //unset($dir_list[array_search($dir,$dir_list)]);
            unset($dir);

        }
        $this->retourneAllVideos($tab_dir,$vf);
        return $vf;
    }

}
