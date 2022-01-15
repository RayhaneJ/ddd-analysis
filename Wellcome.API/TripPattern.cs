using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Wellcome.API
{
    public class TripPattern
    {
        public string Email { get; set; }
        public int Adults { get; set; }
        public int Babies { get; set; }
        public int Pets { get; set; }
        public int Childs { get; set; }
        public double Longitude { get; set; }
        public double Latitude { get; set; }
    }

}
