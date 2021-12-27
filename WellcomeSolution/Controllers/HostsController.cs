using Microsoft.AspNetCore.Mvc;
using Wellcome.API;

namespace Wellcome.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class HostsController : ControllerBase
    {
        [HttpPost("presenters")]
        public List<HostPresenter> GetHosts() => new HostsService().GetHostsPresenters();

        [HttpPost("presenters/filter")]
        public List<HostPresenter> GetHosts([FromBody] TripPattern pattern) => new HostsService().GetHostsPresenters(pattern);

        [HttpPost("details/{id}")]
        public HostDetails GetHostPicture(int id) => new HostsService().GetHostDetails(id);

    }
}
