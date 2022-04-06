***REMOVED*** Views - Projects. ***REMOVED***

from django.shortcuts import render
from .models import Project


def all_projects(request):
    ***REMOVED*** A view to go to view all Projects page. ***REMOVED***

    projects = Project.objects.all()

    context = {
        'projects': projects,
***REMOVED***

    return render(request, 'projects/projects.html', context)
