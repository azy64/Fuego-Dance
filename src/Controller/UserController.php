<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Repository\PostsRepository;
use App\Repository\RolesRepository;
use App\Repository\StudentsRepository;
use App\Repository\TypePostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class UserController extends AbstractController
{
    /**
     * @Route("/", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    /**
     * @Route("/getstudent/{login}/{pass}", name="user")
     */
    public function getStudent($login,$pass,StudentsRepository $s){
       // $s=$this->getDoctrine()->getRepository("Students");
        $student=$s->findOneBy(["email"=>$login,"pass"=>$pass]);
        $p=array();
        if($student!=null){
            $p["login"]=$student->getEmail();
            $p["pass"]=$student->getPass();
            $p["id"]=$student->getId();
            $p["nom"]=$student->getNom();
            $p["prenom"]=$student->getPrenom();
            $p["sexe"]=$student->getSexe();
            $p=json_encode($p);
        }
        else
            $p=json_encode([]);
        //$pass=$r->query->get("pass");
        //$rp->setContent("<h1>je suis la</h1>");
       // return $rp->sendContent("efefeffeee");
        //$r=new Response($p);
        //$r->headers->set("Content-type","JSON");
        return $this->json($p);
    }

    /**
     * @Route("/getPost", name="post")
     */
    public function getPost(PostsRepository $p){
        //$this->SavePost();
        $posts=$p->findAll();
        $tab=$this->postJson($posts,$p);

       // $tab=json_decode(json_encode($tab),true);
       // var_dump($tab);
        //$r=new Response($this->bullePost($posts));
        //$r=new Response();
        //$r->headers->set("Content-type","application/json;charset:utf-8");

        //$r->setContent($tab);
        return $this->json($tab);
    }
    public function bullePost(array $tab ){
        $retour="";
        foreach ($tab as $el){
            $d=$el->getDatePost();
            $k=new \DateTime("NOW");
            $m=$k->diff($d);
            $retour.="<div class='tunaweza_bulle Tunaweza_near'>".$el->getContents()."</div><div class='Tunaweza_near'>".$m->format('H:m:s')."</div><br>";
        }
        return $retour;
}


    public function postJson(array $tab,PostsRepository $rep ){
        $retour=array();
        $t="";
        $tab=$rep->deskPostByDate($tab);
        foreach ($tab as $el){
            $d=$el->getDatePost();
            //var_dump($d);
            $k=new \DateTime("NOW");
            $m=$k->diff($d);
           // var_dump($m->days);
            //$t=$m->days>0?$m->format("%d")." day(s)":$m->h>0?$m->format("%h")." hours(s)":$m->m>0?$m->format("%d")." minute(s)":$m->format("%s")."second(s)";
            if($m->days>0)
                $t=$m->format("%d")." day(s)";
            elseif ((int)$m->days==0 and (int)$m->h>0)
                $t=$m->format("%H")." Hour(s)";
            elseif ((int)$m->h==0 and (int)$m->m>0)
                $t=$m->format("%m")." minutes(s)";
            elseif ($m->m==0)
                $t=$d->format("H:m:s")."";

            $retour[]=["id"=>$el->getId(),"contents"=>$el->getContents(),"date"=>"<i style='color: #8ca5d2'>".$t."</i>"/*$m->format('%d')*/,"type"=>$el->getTypePost()->getLibele()];
        }
        return $retour;
    }
    /**
     * @Route("/savePost", name="savepost")
     */
    public function SavePost(StudentsRepository $st,TypePostRepository $type,RolesRepository $r){
        $pp=new Posts();
        $pp->setContents("adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
        $pp->setTitle("Un faux texte");
        $pp->setUser($st->findOneBy(array("role"=>1)));
        $pp->setTypePost($type->find(1));
        $this->getDoctrine()->getManager()->persist($pp);
        $this->getDoctrine()->getManager()->flush();
        return new Response("it's done");
    }
    /**
     * @Route("/getPostsAfter/{id}", name="getPostsAfter")
     */
    public function getPostsAfter($id,PostsRepository $p){

    }

}
