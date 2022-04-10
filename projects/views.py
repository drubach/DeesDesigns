""" Views - Projects. """
from django.shortcuts import get_object_or_404, render, reverse, redirect
from django.db.models import Q
from .models import Project


def all_projects(request):
    """ A view for all Projects page, including filtering. """

    projects = Project.objects.all()
    query = None

    if 'query' in request.GET:
        query = request.GET['query']
        if not query:
            return redirect(reverse('projects'))
        queries = (Q(type__icontains=query) | Q(completed__icontains=query)
                    | Q(paid__icontains=query))
        projects = Project.objects.filter(queries)

    context = {
        'page': 'projects',
        'projects': projects,
        'search_term': query,
    }

    return render(request, 'projects/projects.html', context)


def project_detail(request, project_id):
    """ A view to get project detail page. """

    project = get_object_or_404(Project, pk=project_id)

    context = {
        'page': 'projects',
        'project': project,
    }

    return render(request, 'projects/project_detail.html', context)
