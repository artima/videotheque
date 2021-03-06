<?php

namespace MI\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;
/**
 * FilmRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FilmRepository extends EntityRepository
{
    public function getSearchFilm($data)
    {
        $category = $data['category'];
        $qb = $this->createQueryBuilder('f');
        if($category != '')
        {
            $libelle = $category->getLibelle();
            $qb->join('f.categories', 'c')
            ->addSelect('c');
            $qb->where('c.libelle = :libelle')
                ->setParameter('libelle', $libelle);

        }
        if($data['titre'] != '')
        {
            $titre = $data['titre'];
            $qb->andWhere('f.titre like :titre')
                ->setParameter('titre', '%'.$titre.'%');
        }
        if($data['date_ajout'] != '')
        {
            $date = $data['date_ajout'];
            $qb->andWhere('f.date like :date')
                ->setParameter('date', '%'.$date.'%');
        }
                return $qb
                    ->getQuery()
                    ->getResult();
    }
}
