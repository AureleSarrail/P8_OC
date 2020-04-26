| Property     | Value                                                        |
|---|---|
| Route Name   | task_delete                                                  |
| Path         | /tasks/{id}/delete                                           |
| Path Regex   | #^/tasks/(?P<id>[^/]++)/delete$#sD                           |
| Host         | ANY                                                          |
| Host Regex   |                                                              |
| Scheme       | ANY                                                          |
| Method       | ANY                                                          |
| Requirements | NO CUSTOM                                                    |
| Class        | Symfony\Component\Routing\Route                              |
| Defaults     | _controller: App\Controller\TaskController::deleteTaskAction |
| Options      | compiler_class: Symfony\Component\Routing\RouteCompiler      |
