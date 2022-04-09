***REMOVED*** Views - Projects. ***REMOVED***
from django.shortcuts import get_object_or_404, render
from .models import Project


def all_projects(request):
    ***REMOVED*** A view for all Projects page. ***REMOVED***

    projects = Project.objects.all()

    context = {
        'projects': projects,
***REMOVED***

    return render(request, 'projects/projects.html', context)


def project_detail(request, project_id):
    ***REMOVED*** A view to get project detail page. ***REMOVED***

    project = get_object_or_404(Project, pk=project_id)

    context = {
        'page': 'projects',
        'project': project,
***REMOVED***

    return render(request, 'projects/project_detail.html', context)
