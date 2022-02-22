<?php

namespace KamilCraftApi\App\Models;

use stdClass;

class Project
{
    const JSON_PATH = ROOT_PATH . 'resources/json';
    const SHORT_PROJECT = [
        'id',
        'title',
        'image',
        'categories',
        'version'
    ];
    private array $allProjects = [];

    public function __construct()
    {
        $projects = file_get_contents(self::JSON_PATH . '/Projects.json');
        if ( $projects = json_decode($projects) ) {
            $this->allProjects = $projects;
        }
    }

    public function getProject(int $id): object|bool
    {
        if ( ( $key = array_search($id, array_column($this->allProjects, 'id')) ) !== false ) {
            return $this->allProjects[$key];
        }
        return false;
    }

    public function getProjectWhereCategory(string $category): array
    {
        $listWhereCategory = [];
        foreach ( array_column($this->allProjects, 'categories') as $key => $value ) {
            if ( in_array($category, $value) ) {
                $listWhereCategory[] = $this->shortProjectSchema($this->allProjects[$key]);
            }
        }
        return $listWhereCategory;
    }

    private function shortProjectSchema(object $project): object
    {
        $tmp_project = new stdClass;
        foreach ($project as $key => $value) {
            if ( in_array($key, self::SHORT_PROJECT) ) {
                $tmp_project->{$key} = $value;
            }
        }
        $tmp_project->short_description = substr(
            explode("\n", $project->description)[0],
            0,
            255
        );

        return $tmp_project;
    }

    public function __invoke(): array
    {
        $arr_map = [];
        foreach ($this->allProjects as $project) {
            $arr_map[] = $this->shortProjectSchema($project);
        }

        return $arr_map;
    }
}
