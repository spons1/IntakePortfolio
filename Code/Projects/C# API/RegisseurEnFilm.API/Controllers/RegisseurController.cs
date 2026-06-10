using Microsoft.AspNetCore.Mvc;
using RegisseurEnFilm.API.DTO.Regisseurs;
using RegisseurEnFilm.API.Repositories;

namespace RegisseurEnFilm.API.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class RegisseurController : Controller
    {
        private readonly RegisseurRepository regisseurRepository;

        public RegisseurController(RegisseurRepository regisseurRepository)
        {
            this.regisseurRepository = regisseurRepository;
        }

        [HttpGet]
        public ActionResult<IEnumerable<RegisseurListItem>> GetAllRegisseurs()
        {
            var regisseurs = regisseurRepository.GeefAlleRegisseurs();
            return Ok(regisseurs);
        }

        [HttpGet("search/{naam}")]
        public ActionResult<IEnumerable<RegisseurListItem>> ZoekRegisseurs([FromQuery] string titel)
        {
            var regisseurs = regisseurRepository.ZoekNaarRegisseur(titel);
            return Ok(regisseurs);
        }

        [HttpPost]
        public IActionResult MaakRegisseurAan([FromBody] RegisseurCreateRequest request)
        {
            regisseurRepository.maakRegisseurAan(request);
            return CreatedAtAction(nameof(ZoekRegisseurs), new { naam = request.Naam }, request);
        }
    }
}
