<?php

namespace Aggressiveswallow\Repositories;

use Aggressiveswallow\Models\BaseEntity;
use Aggressiveswallow\Queries\Treequeries\AddQuery;
use Aggressiveswallow\Queries\Treequeries\SubtractQuery;

/**
 * Description of HierachyRepository
 *
 * @author Patrick
 */
class TreeRepository
        extends GenericRepository {

    /**
     *
     * @var Aggressiveswallow\Queries\Treequeries\AddQuery
     */
    private $addQuery;

    /**
     *
     * @var Aggressiveswallow\Queries\Treequeries\SubtractQuery
     */
    private $subtractQuery;

    public function create(BaseEntity $object) {
        if (!is_a($object, "\Aggressiveswallow\Models\Tree")) {
            throw new \Exception("Not a valid `Tree` object given.");
        }

        $this->addQuery->setId($object->getLft());
        $this->addQuery->run();
        parent::create($object);
        return $object;
    }

    public function delete(BaseEntity $object) {
        $rgt = $object->getRgt();

        $this->subtractQuery->setId($rgt);
        $this->subtractQuery->run();
        parent::delete($object);
    }

    public function update(BaseEntity $object) {
        parent::update($object);
    }

    public function setAddQuery(AddQuery $addQuery) {
        $this->addQuery = $addQuery;
    }

    public function setSubtractQuery(SubtractQuery $subtractQuery) {
        $this->subtractQuery = $subtractQuery;
    }

    public function setQueries(AddQuery $addQuery, SubtractQuery $subtractQuery) {
        $this->setAddQuery($addQuery);
        $this->setSubtractQuery($subtractQuery);
    }

}
