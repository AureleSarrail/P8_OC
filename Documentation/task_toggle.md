| Property     | Value                                                        |
|---|---|
| Route Name   | task_toggle                                                  |
| Path         | /tasks/{id}/toggle                                           |
| Path Regex   | #^/tasks/(?P<id>[^/]++)/toggle$#sD                           |
| Host         | ANY                                                          |
| Host Regex   |                                                              |
| Scheme       | ANY                                                          |
| Method       | ANY                                                          |
| Requirements | NO CUSTOM                                                    |
| Class        | Symfony\Component\Routing\Route                              |
| Defaults     | _controller: App\Controller\TaskController::toggleTaskAction |
| Options      | compiler_class: Symfony\Component\Routing\RouteCompiler      |
